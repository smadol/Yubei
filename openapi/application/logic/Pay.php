<?php
/**
 * Created by 小羊.
 * Author: 勇敢的小笨羊
 * 微博: http://weibo.com/xuzuxing
 * Date: 2018/3/18
 * Time: 21:33
 */

namespace app\logic;

use app\model\Channel;
use app\model\Orders;
use app\library\exception\OrderException;
use think\Log;
use Yansongda\Pay\Pay as Service;

class Pay extends BaseLogic
{
    private $orderNo;
    private $channel;

    /**
     * @author 勇敢的小笨羊
     * @param $orderNo
     * @return \Symfony\Component\HttpFoundation\Response|\Yansongda\Supports\Collection
     */
    public function pay($orderNo)
    {
        //检查支付状态
        $order = $this->modelOrders->checkOrderValid($orderNo);
        $this->channel = $this->modelChannel->getChannel($order['channel']);
        Log::record("PAY_ORDER: [{$order}]");
        //创建支付预订单
        return $this->preOrder($order);
    }

    /**
     * @author 勇敢的小笨羊
     * @param $order
     * @return \Symfony\Component\HttpFoundation\Response|\Yansongda\Supports\Collection
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
            default:
                $result = $this->makeWxOrder($order);
                break;
        }
        Log::record('PAY_RESULT:'.$result);
        return $result;
    }

    private function makeAliOrder($order){

        $config = [
            'alipay'  => [

                //应用ID,您的APPID。
                'app_id' => "2018030402313504",
                //商户私钥, 请把生成的私钥文件中字符串拷贝在此
                'private_key'    =>'MIIEowIBAAKCAQEAp7f6gGT8GXS2glJ48hOdj6FgRKTTFzqho9IMxIlfcIpieQ4NO3jyl36tRxSQUtt8pUp85Z9v6/fqI1bt7dq4NPdero14dXgzL3XZt18QPAVntosqEjyI0QgiZZg3oXnh4fEgDwln+NFs8T/Ni/BDHMwzpuRpnNdglr6167kRj1frxjLWGUAgo3gmKQgZiVOmeFGNWEJ3vlB6nhfIrQOi2p+nPbPLOQKyUiJeGKh1aR3qGtFrUUpIYasizx3Kg/xdxMISzMSVOqDIxeVCB9FWSJXr9Ws6uErmpBI7lXmaAs3144Ie5rqRbKslMriJ3ovdaLlmTlXDxjbTR/AGsKu3XQIDAQABAoIBABX2a6FAmBqlQ/kQ37Gji/BxC3AxvUq/bMdNDEr4Sj0sgfSkOGtfTTU1a29xa+zNvSbP+EcBd+CImGqESafqClE1S3rEH9ASK3G9lwMCOdgCRTCMTLgSoT/uNsLjCfXlRgUWVEJj0u+sTP3SgxIeJkuxGdpy8rmNIqLa2mvB0mDYxiytOVyMO+J8amaTbz/MllRxa+iAxIbd/M12rrV3vvEYUgitvK4uXER62MZMyIvOW6Cf+CLfOq3Tsp+M1Jve4ox/xJOrg1815e9//+7hHcujjCo5XiG+u1rVyH+Tr/Qs6Rdk+CVgBiZ/YqWMSdFUBkUIYCKazzeVkzCkx0eJYIECgYEA3bIM0H7kCwfAHiWm5EGXEW8qoSTqc8bZMG5S6D2BuMTTVixRcfDTJlt2daKfxLRsU1ijrG6EVKaLblrBOFVJb1WYrgxgKkoUHIUqNwGMnTTe3dj8w2uA5/IUYcqmzwO5Rb49mc/1ATzzMqn2kUck5Vts9i8DpJUe0PLYJ7VkT5ECgYEAwavDC5NkPrE/QOYmvy1Aqj5vhKIr5W6IEGSGDMIfZ2e7o08URfRkc5jprZozcOl3MuseCE1I6ysIyDlvHtbV0eAl128xUWI5HXIC8zGrYJQ95Fsl2Xd6yymEC6CUKgnae2WyyOls3QM56XAmZbh1W+QN8Hsb5X0yLTii8LDsXQ0CgYB6AzVERqHxZCmbLfPFKkgfY0Rd/fg/EhCUtBNTGA7eBw2dHrUQdY9wS+RNZ9xwoTABSwaBry2LfUG90ZsICwBokv59w/flLnIVJEEQlvyxxNhn1rV+RBtlDHmlPKhDxPPh64rxrV9VeBsNJje6yyIGTSQR9dwWZ6/XJeBLMmzr0QKBgQC0uXeVAcF1zyjbgul9VNkXBJREDKExw+cshOGiXjO35tDuIAknDlv+kx7cZRzDrNkSptyrmpMFAG99iDrtaES3SJeHZbd73lC17YJbNmpaAXuP8I5tVFU96EvUHdClOfSrWcdwPILd6vjLoV/zZCH/0dxAIGFz0VRVZpiGSlMGsQKBgET9vKqOSvI88W8/Ve3YGOoXQ5qjrm5JqbL/J8f4GiOoDrBfaYij2Yg2WZlaPWi5t1KXh8IsN/Yn6NenY8CiI5hQZi/0CQM5ICEZmCnX3U1QdpffGzAbd/tb4ldmA3ez3cYNPzIP3q1bUQ3ybwO2eD8N978mHXBokoO0AHh01thZ',
                //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
                'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAix0lmphMY4htd8sw6kLMBGyju6p2y4pQtmiUpk7KxIV2NaUj0Zve2WJvPDptbKB0Lmn3EksPVG8VCrlh97shKjerm0gW314YN1DY/7RFPqxeeYNIFaMiGgf1ecMZUAOwO/v8NKn2nKH5hA0eMFxXNTtAXfSY/UBBnMFWOd765uQsXNn6r0PjhIpC2T9Hk+KfVm2eQ3QqY82/s0SaeebN/xjbkTsAc6yKGPCJxbe2vyE5coQ8iCj4pVvlFX6+SO+lEFvB56r8H+dQlDixPGgEGz+PZkUny7SZjFBZm5amH6XEl40ac9iWuuaW2C28FMoHX6XjJgu95aZMeVa5ZCrqmQIDAQAB',
                //异步通知地址
                'notify_url' => "https://openapi.98imo.com/alipay/notify",
                //同步跳转
                'return_url' => "https://openapi.98imo.com/alipay/redirect",
                'log' => [ // optional
                    'file' => RUNTIME_PATH .'./pay/alipay.log',
                    'level' => 'debug'
                ]
            ]
        ];
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

    private function makeWxOrder($order){

        //构建支付配置
//        $config = [
//            'app_id'          => $this->channel['appid'],      // 微信公众号 APPID
//            'miniapp_id'      => $this->channel['appid'],      // 小程序 APPID
//            'mch_id'          => $this->channel['mchid'],              // 微信商户号
//            'notify_url'      => 'https://openapi.98imo.com/wxpay/notify',
//            'key'             => $this->channel['key'],  // 微信支付签名秘钥
//            //'cert_client'     => CRET_PATH.'./wxpay/apiclient_cert.pem',
//            //'cert_key'        => CRET_PATH.'./wxpay/apiclient_key.pem',
//            'log' => [ // optional
//                'file' => RUNTIME_PATH .'./pay/wechat.log',
//                'level' => 'debug'
//            ]
//        ];
        $orderData = [
            'out_trade_no'  => $order['out_trade_no'],      //平台支付单号
            'total_fee'     => $order['amount']*100,   //支付金额
            'body'          => $order['subject'], //支付项目
        ];
        $wxOrder = Service::wechat(config('wx.wechat'))->scan($orderData);
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
        $qpay = Service::qpay(config('qq.qpay'))->scan($orderData);
        if ($qpay['return_code'] != 'SUCCESS' || $qpay['result_code'] != 'SUCCESS') {
            Log::record(json_encode($qpay), 'error');
            Log::record('获取预支付订单失败', 'error');
        }
        return $qpay;
    }

}