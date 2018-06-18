<?php
/**
 * Created by 小羊.
 * Author: 勇敢的小笨羊
 * 微博: http://weibo.com/xuzuxing
 * Date: 2018/3/18
 * Time: 21:33
 */

namespace app\service;

use app\model\PayOrder;
use app\library\exception\OrderException;
use think\Log;
use Yansongda\Pay\Pay;

class YuPay
{
    private $orderNo;

    /**
     * QPay constructor.
     * @param $orderNo
     * @throws OrderException
     */
    function __construct($orderNo)
    {
        if (!$orderNo)
        {
            throw new OrderException([
                'msg'   =>  '订单号不允许为NULL'
            ]);
        }
        $this->orderNo = $orderNo;
    }


    /**
     * @return mixed
     * @throws OrderException
     * @throws \think\exception\DbException
     */
    public function pay()
    {
        //检查支付状态
        $order = $this->checkOrderValid();
        Log::record("PAY_ORDER: [{$order}]");
        //创建支付预订单
        return $this->preOrder($order);
    }

    /**
     * @param $order
     * @return \Yansongda\Pay\Gateways\Alipay\WapGateway
     * @return \Yansongda\Pay\Gateways\Alipay\WebGateway
     * @return \Yansongda\Pay\Gateways\Wechat\ScanGateway
     */
    private function preOrder($order){
        //判断支付方式
        switch ($order['channel']){
            case 'ALIPAY':
                $result = $this->makeAliOrder($order);
                break;
            case 'WXPAY':
                $result = $this->makeWxOrder($order);
                break;
            case 'QQPAY':
                $result = $this->makeQpayOrder($order);
                break;
        }
        Log::record('PAY_RESULT:'.$result);
        return $result;
    }

    private function makeAliOrder($order){
        $orderData = [
            'out_trade_no' => $this->orderNo,      //平台支s付单号
            'total_amount' => $order['amount'],   //支付金额
            'subject'      => $order['subject'], //支付项目
        ];

        //是否手机端
        if(request()->isMobile()){
            $alipay = Pay::alipay(config('ali.alipay'))->wap($orderData);
        }else{
            $alipay = Pay::alipay(config('ali.alipay'))->web($orderData);
        }
        return $alipay;
    }

    private function makeWxOrder($order){
        $orderData = [
            'out_trade_no'  => $this->orderNo,      //平台支付单号
            'total_fee'     => $order['amount']*100,   //支付金额
            'body'          => $order['subject'], //支付项目
        ];

        $wxOrder = Pay::wechat(config('wx.wechat'))->scan($orderData);
        if($wxOrder['return_code'] != 'SUCCESS' || $wxOrder['result_code'] !='SUCCESS'){
            Log::record($wxOrder,'error');
            Log::record('获取预支付订单失败','error');
        }
        return $wxOrder;
    }

    /**
     * 构建QQ钱包支付
     */
    private function makeQpayOrder($order)
    {
        //入参
        $orderData = [
            'out_trade_no'  => $this->orderNo,      //平台支付单号
            'total_fee'     => $order['amount']*100,   //支付金额
            'body'          => $order['subject'], //支付项目
        ];
        $qpay = Pay::qpay(config('qq.qpay'))->scan($orderData);
        if ($qpay['return_code'] != 'SUCCESS' || $qpay['result_code'] != 'SUCCESS') {
            Log::record(json_encode($qpay), 'error');
            Log::record('获取预支付订单失败', 'error');
        }
        return $qpay;
    }

    /**
     * 订单检查
     * @return string
     * @throws OrderException
     * @throws \think\exception\DbException
     */
    private function checkOrderValid()
    {
        $order = PayOrder::get(['trade_no' => $this->orderNo]);
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
}