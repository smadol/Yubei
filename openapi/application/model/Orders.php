<?php
/**
 * Author: Single Dog
 * Github: https://github.com/SingleSheep
 * Date: 2018/2/6 - 22:08
 */

namespace app\model;
use think\Db;
use think\Log;
use app\library\exception\OrderException;

class Orders extends BaseModel
{

    /**
     * @author 勇敢的小笨羊
     * @param $orderData
     * @return mixed
     * @throws \think\Exception
     */
    public function addOrder($orderData){
        Db::startTrans();
        try{
            $order = new Orders();
            $order->uid         = $orderData['mchid']; //商户ID
            $order->subject     = $orderData['subject'];//支付项目
            $order->body        = $orderData['body'];//支付具体内容
            $order->trade_no    = create_order_no();//支付单号
            $order->out_trade_no= $orderData['out_trade_no'];//商户单号
            $order->amount      = $orderData['amount'];//支付金额
            $order->currency    = $orderData['currency'];//支付货币
            $order->channel     = $orderData['channel'];//支付渠道
            $order->client_ip   = $orderData['client_ip'];//订单创建IP
            $order->return_url  = $orderData['return_url'];//通知Url
            $order->notify_url  = $orderData['notify_url'];//通知Url
            $order->extra       = json_encode($orderData['extparam']);//拓展参数
            $order->save();

            //  余额 = 可用余额（可提现金额） + 冻结余额（待结算金额） =》 未支付金额每日清算
            //   可用余额是从冻结余额转入的
            //写入待支付金额
            //Balance::IncDis($orderData['mchid'],$orderData['amount']);
            $result = $this->logicPay->pay($order->trade_no);  //支付
            Db::commit();
            return $result;

        }catch (\Exception $e){
            Log::record("ERROR:[{$e->getMessage()}]");
            Db::rollback();
            throw new OrderException([
                'msg'   =>  "Create Payment Order Error, Please Try Again Later."
            ]);
        }
    }

    /**
     * 订单状态检查
     * @param $orderNo
     * @return string
     * @throws OrderException
     * @throws \think\exception\DbException
     */
    public function checkOrderValid($orderNo)
    {
        $order = self::get(['trade_no' => $orderNo]);
        if (!$order) {
            throw new OrderException([
                'msg' => '订单异常'
            ]);
        }

        if ($order['status'] === 2) {
            throw new OrderException([
                'msg' => '支付订单异常',
                'errorCode' => 80003,
                'code' => 400
            ]);
        }
        return $order;
    }

    /**
     * @author 勇敢的小笨羊
     * @param $outTradeOrderNo
     * @return Orders|bool
     * @throws \think\exception\DbException
     */
    public function getOutTradeOrder($outTradeOrderNo){
        $order = self::get(['out_trade_no' => $outTradeOrderNo]);
        if ($order) {
            return $order;
        }
        return false;
    }
}