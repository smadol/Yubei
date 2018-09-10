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

class BuildHeader extends ApiSend
{

    /**
     * 构建头信息
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $chargeRespose
     * @return mixed|void
     */
    public function doBuild($chargeRespose)
    {
        // 构建头信息
        $header = [
            'noncestr'  =>  static::get('noncestr'),
            'timestamp' =>  static::get('timestamp'),
            'signature' =>  static::get('signature')
        ];
        //记录本次签名
        static::set('header',$header);
    }

}