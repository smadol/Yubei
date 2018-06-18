<?php
/**
 * Created by 小羊.
 * Author: 勇敢的小笨羊
 * 微博: http://weibo.com/xuzuxing
 * Date: 2018/3/18
 * Time: 18:03
 */


namespace app\service;

use app\model\Asset;
use app\model\PayOrder;
use app\model\Transaction;
use think\Db;
use think\Exception;
use think\Log;
use Yansongda\Pay\Pay;

/**
 * 支付回调
 * Class YuPayNotify
 * @package app\api\service
 */
class YuPayNotify extends YuPayUtil
{

    /**
     *
     * @param $data
     * @return mixed
     */
    public function handle($data){

        Db::startTrans();
        try{
            //获取支付订单号
            $trade_no = $data->out_trade_no;
            //查找订单
            $order = (new PayOrder())->where(['trade_no'=>$trade_no])
                ->lock(true)
                ->find();
            if ($order->status == 1) {
                //更新订单状态
                $this->updateOrderStatus($order->id, true);
                //自增商户资金
                $this->changeWalletData($order->uid, $order->amount);
                //记录交易流水
                $this->recordTransaction($order);
                //异步消息商户
                $this->returnNotify($order);
            }

            Db::commit();
        } catch (Exception $ex) {
            Db::rollback();
            Log::error($ex);
        }

        return true;
    }
    /**
     * 更新支付单状态
     * @param $id
     * @param $success
     */
    private function updateOrderStatus($id, $success)
    {
        $status = $success ? 2 : 1;
        (new PayOrder())->where(['id' => $id])
            ->update([ 'status' => $status ]);
    }

    /**
     * 记录交易流水
     * @param $order
     */
    private function recordTransaction($order)
    {
        $trans = new Transaction();
        $trans->order_no = $order->order_no;
        $trans->amount   = $order->amount;
        $trans->channel  = $order->channel;
        $trans->save();
    }

    /**
     * 更新商户账户余额
     * 交易前存入disable
     * 交易支付完成转入available
     * 结算的时候加入assets
     * @param $uid
     * @param $fee
     * @throws Exception
     */
    private function changeWalletData($uid, $fee)
    {
        (new Asset())->where(['uid' => $uid])->setInc('available', $fee);
        (new Asset())->where(['uid' => $uid])->setDec('disable',$fee);
    }

    /**
     * 返回商户支付成功
     * @param $order
     */
    private function returnNotify($order){
        //支付成功 向商户返回XML成功通知
        $inputObj = new YuPayReply();
        $inputObj->SetReturn_code('SUCCESS');
        $inputObj->SetReturn_msg('OK');
        $inputObj->SetReturn_fee($order->amount);
        $inputObj->SetOut_No($order->out_trade_no);
        $inputObj->SetSign();
        $data = $inputObj->GetValues();
        Log::record(json_encode($data));
        $respose = curl_post_raw($order->notify_url,json_encode($data));
        Log::record($respose);
        //这里要做5次回传数据 返回正确才会停止回传
//        curl_post_xml($data,$order->notify_url);

    }

    /**
     * 回转商户
     * @return mixed
     * @throws \Yansongda\Pay\Exceptions\InvalidSignException
     * @throws \think\exception\DbException
     */
    public function backBusiness(){
        $data = Pay::alipay(config('ali.alipay'))->verify();
        // 是的，验签就这么简单！
        // 订单号：$data->out_trade_no
        // 支付宝交易号：$data->trade_no
        // 订单总金额：$data->total_amount
        $order = PayOrder::get(['order_no' => $data->out_trade_no]);
        return $order['return_url'];
    }
}
