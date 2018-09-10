<?php
/**
 * +---------------------------------------------------------------------+
 * | Yubei      | [ WE CAN DO IT JUST THINK ]
 * +---------------------------------------------------------------------+
 * | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )
 * +---------------------------------------------------------------------+
 * | Author     | Brian Waring <BrianWaring98@gmail.com>
 * +---------------------------------------------------------------------+
 * | Company    | 小红帽科技      <Iredcap. Inc.>
 * +---------------------------------------------------------------------+
 * | Repository | https://github.com/BrianWaring/Yubei
 * +---------------------------------------------------------------------+
 */

namespace app\logic;

use app\logic\notify\PayReply;
use app\logic\notify\PayUtil;
use app\model\Balance;
use app\model\Orders;
use app\model\Transaction;
use think\Db;
use think\Exception;
use think\Log;
use Yansongda\Pay\Pay;

class Notify extends BaseLogic
{
    use PayUtil;

    /**
     * 支付回调助手
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $data
     * @return bool
     */
    public function handle($data){
        Db::startTrans();
        try{
            //获取支付订单号
            $trade_no = $data->out_trade_no;
            //查找订单
            $order = (new Orders())->where(['trade_no'=>$trade_no])
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
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $id
     * @param $success
     */
    private function updateOrderStatus($id, $success)
    {
        $status = $success ? 2 : 1;
        (new Orders())->where(['id' => $id])
            ->update([ 'status' => $status ]);
    }

    /**
     * 记录交易流水
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
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
     * 更新商户账户余额  交易前disable 交易完成available <之间系统当日结算次日打款> 结算balance
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $uid
     * @param $fee
     * @throws Exception
     */
    private function changeWalletData($uid, $fee)
    {
        $model = new Balance();
        //支付成功  写入待结算金额
        $model->where(['uid'=> $uid])->setInc('available',$fee );
        //支付成功  扣除待支付金额
        $model->where(['uid'=> $uid])->setDec('disable', $fee);
    }

    /**
     * 返回商户支付成功 这里应该药用到队列处理  （暂不处理20180910）
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $order
     */
    private function returnNotify($order){
        //支付成功 向商户返回XML成功通知
        /*$inputObj = new PayReply();
        $inputObj->SetReturn_code('SUCCESS');
        $inputObj->SetReturn_msg('OK');
        $inputObj->SetReturn_fee($order->amount);
        $inputObj->SetOut_No($order->out_trade_no);
        $inputObj->SetSign();
        $data = $inputObj->GetValues();
        Log::record(json_encode($data));
        $respose = curl_post_raw($order->notify_url,json_encode($data));
        Log::record($respose);*/
        //这里要做5次回传数据 返回正确才会停止回传
//        curl_post_xml($data,$order->notify_url);

    }

    /**
     * 支付完成跳转转商户
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     * @throws \Yansongda\Pay\Exceptions\InvalidConfigException
     * @throws \Yansongda\Pay\Exceptions\InvalidSignException
     * @throws \think\exception\DbException
     */
    public function backBusiness(){
        $data = Pay::alipay(config('ali.alipay'))->verify();
        // 是的，验签就这么简单！
        // 订单号：$data->out_trade_no
        // 支付宝交易号：$data->trade_no
        // 订单总金额：$data->total_amount
        $order = Orders::get(['order_no' => $data->out_trade_no]);
        return $order['return_url'];
    }
}
