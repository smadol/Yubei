<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\logic\response;


use app\logic\Encryption;
use think\Log;

class BuildHeader extends ApiSend
{

    /**
     * 构建头信息
     *
     * @author 勇敢的小笨羊
     * @param array $chargeRespose
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