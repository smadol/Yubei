<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\service\response;

use think\Log;

class BuildCharge extends ApiSend
{
    /**
     * 构建支付对象返回
     *
     * @author 勇敢的小笨羊
     * @param array $chargeRespose 第三方返回的支付信息包
     */
    public function doBuild($chargeRespose)
    {
        //从请求上下文取出商户支付申请数据
        $payload = static::get('payload');
        $ApiResposeData = [
            'channel'=>$payload['channel'],
            'order_no'=>$payload['out_trade_no'],
            'client_ip'=>$payload['client_ip'],
            'amount'=>$payload['amount'],
            'currency'=>$payload['currency'],
            'subject'=>$payload['subject'],
            'body'=>$payload['body'],
            'extra'=>$payload['extparam'],
            'credential'=>[
                'prepay_id'=>$chargeRespose['prepay_id'],
                'order_qr'=>$chargeRespose['code_url']
            ]
        ];
        Log::record('Api Respose Data:'.json_encode($ApiResposeData));
        // 设置上下文支付包
        static::set('ApiResposeData',$ApiResposeData);
    }

}