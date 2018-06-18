<?php

/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace Yubei;

use Yubei\Util\Encryption;
use Yubei\Util\YubeiObject;

class Charge extends YubeiObject
{

    /**
     * @param null $params
     * @return mixed
     * @throws Exception\Exception
     * @throws exception\AuthorizationException
     * @throws exception\InvalidRequestException
     */
    public static function create($params = null)
    {

        return self::_request(Yubei::$baseUrl,$params);
    }

    /**
     * @param $chargeId
     * @return mixed|string
     * @throws Exception\Exception
     * @throws exception\AuthorizationException
     * @throws exception\InvalidRequestException
     */
    public static function retrieve($chargeId)
    {
        if (empty($chargeId)){
            return 'chargeId can not be blank.';
        }
        return self::_request(Yubei::$baseUrl.'/'.$chargeId);
    }
}
