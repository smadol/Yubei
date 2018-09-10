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

namespace app\service\response;

use think\Log;

class BuildCharge extends ApiSend
{
    /**
     * 构建支付对象返回
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $chargeRespose
     * @return mixed|void
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
        Log::notice('Api Respose Data:'.json_encode($ApiResposeData));
        // 设置上下文支付包
        static::set('ApiResposeData',$ApiResposeData);
    }

}