<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\logic\response;


use app\logic\Encryption;
use think\Log;

class BuildSign extends ApiSend
{

    /**
     * @author 勇敢的小笨羊
     * @param array $payload
     */
    public function doBuild($payload)
    {
        $_to_sign_data = utf8_encode(self::get('noncestr'))
            ."\n" . utf8_encode(self::get('timestamp'))
            ."\n" . utf8_encode(self::get('authentication'))
            ."\n" . utf8_encode(json_encode(static::get('ApiResposeData')));
        //记录本次签名
        static::set('signature',Encryption::encrypt($_to_sign_data));
    }

}