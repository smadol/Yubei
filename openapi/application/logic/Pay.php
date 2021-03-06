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

use think\Log;
use Yansongda\Pay\Pay as Service;

/**
 * 支付处理类  （优化方案：提出单个支付类  抽象类对象处理方法 便于管理）
 *
 * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
 *
 */
class Pay extends BaseLogic
{
    private $orderNo;

    /**
     * 勇敢的小笨羊
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $orderNo
     * @return \Symfony\Component\HttpFoundation\Response|\Yansongda\Supports\Collection
     */
    public function pay($orderNo)
    {
        //检查支付状态
        $order = $this->modelOrders->checkOrderValid($orderNo);
        //halt($order);
        Log::notice("PAY_ORDER: [{$order}]");
        //创建支付预订单
        return $this->preOrder($order);
    }

    /**
     * 指定网关
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $order
     * @return \Symfony\Component\HttpFoundation\Response|\Yansongda\Supports\Collection
     */
    private function preOrder($order){
        //传入支付方式码号  获取支付商户   SC:  wx_scan  ->  {"appid":"151531352321","key":"66666666"}
        $config = $this->modelChannel->getChannel($order['channel']);
        //判断支付方式
        switch ($order['channel']){
            case 'ali_scan':
            case 'ali_web':
            case 'ali_wap':
            case 'ali_app':
                $result = $this->makeAliOrder($order,$config);
                break;
            case 'wx_scan':
            case 'wx_h5':
            case 'wx_app':
                $result = $this->makeWxOrder($order,$config);
                break;
            case 'qq_scan':
                $result = $this->makeQpayOrder($order,$config);
                break;
            default:
                $result = $this->makeWxOrder($order,$config);
                break;
        }
        Log::notice('PAY_RESULT:'.$result);
        return $result;
    }

    /**
     * 发起支付宝支付请求
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $order
     * @param $config
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function makeAliOrder($order,$config){

        $orderData = [
            'out_trade_no' => $this->orderNo,     //平台支s付单号
            'total_amount' => $order['amount'],   //支付金额
            'subject'      => $order['subject'],  //支付项目
        ];

        //是否手机端
        if(request()->isMobile()){
            $alipay = Service::alipay($config)->wap($orderData);
        }else{
            $alipay = Service::alipay($config)->web($orderData);
        }
        return $alipay;
    }

    /**
     * 发起微信支付请求
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $order
     * @param $config
     * @return \Yansongda\Supports\Collection
     */
    private function makeWxOrder($order,$config){

        //构建支付配置
        $payload = [
            'app_id'          => $config['appid'],      // 微信公众号 APPID
            'miniapp_id'      => $config['appid'],      // 小程序 APPID
            'mch_id'          => $config['mchid'],              // 微信商户号
            'notify_url'      => 'https://openapi.98imo.com/wxpay/notify',
            'key'             => $config['key'],  // 微信支付签名秘钥
            //'cert_client'     => CRET_PATH.'./wxpay/apiclient_cert.pem',
            //'cert_key'        => CRET_PATH.'./wxpay/apiclient_key.pem',
            'log' => [ // optional
                'file' => RUNTIME_PATH .'./pay/wechat.log',
                'level' => 'debug'
            ]
        ];

        $orderData = [
            'out_trade_no'  => $order['trade_no'],      //平台支付单号trade_no   商户订单 out_trade_no
            'total_fee'     => $order['amount']*100,   //支付金额
            'body'          => $order['subject'], //支付项目
        ];
        $wxOrder = Service::wechat($payload)->scan($orderData);
        if($wxOrder['return_code'] != 'SUCCESS' || $wxOrder['result_code'] !='SUCCESS'){
            Log::record($wxOrder,'error');
            Log::record('获取预支付订单失败','error');
        }
        return $wxOrder;
    }

    /**
     * 发起QQ钱包支付请求
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $order
     * @param $config
     * @return mixed
     */
    private function makeQpayOrder($order,$config)
    {
        //入参
        $orderData = [
            'out_trade_no'  => $this->orderNo,      //平台支付单号
            'total_fee'     => $order['amount']*100,   //支付金额
            'body'          => $order['subject'], //支付项目
        ];
        $qpay = Service::qpay(config('qq.qpay'))->scan($orderData);
        if ($qpay['return_code'] != 'SUCCESS' || $qpay['result_code'] != 'SUCCESS') {
            Log::record(json_encode($qpay), 'error');
            Log::record('获取预支付订单失败', 'error');
        }
        return $qpay;
    }

}