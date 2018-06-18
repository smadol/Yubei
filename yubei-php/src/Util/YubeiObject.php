<?php

/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace Yubei\Util;

use Yubei\exception\AuthorizationException;
use Yubei\exception\InvalidRequestException;
use Yubei\Yubei;

class YubeiObject
{

    /**
     * @param null $url
     * @param null $params
     * @return mixed
     * @throws AuthorizationException
     * @throws InvalidRequestException
     * @throws \Yubei\Exception\Exception
     */
    protected static function _request($url = null, $params = null)
    {
        $opts = self::_validateParams($params);
        $respose = new HttpService();
        if (empty($opts)){
            return $respose->get($url, null, 5);
        }else {
            return $respose->post($url, $opts, 5);
        }
    }

    /**
     * @param $options
     * @return mixed
     * @throws AuthorizationException
     * @throws InvalidRequestException
     */
    private static function _validateParams($options)
    {
        //参数填充
        if (!array_key_exists('mchid', $options)) {
            $options['mchid'] = Yubei::getMchId();
        }
        if (!array_key_exists('return_url', $options)) {
            $options['return_url'] = Yubei::getReturnUrl();
        }
        if (!array_key_exists('notify_url', $options)) {
            $options['notify_url'] =Yubei::getNotifyUrl();
        }
        if (!array_key_exists('client_ip', $options)) {
            $options['client_ip'] = $_SERVER['REMOTE_ADDR'];
        }

        if (empty(Yubei::getPrivateKeyPath())){
            throw new InvalidRequestException("The Path of RSA Private Key can not be blank.");
        }

        if (empty(Yubei::getYubeiPublicKeyPath())){
            throw new AuthorizationException("The Path of Yubei Public Key can not be blank.");
        }
        return $options;

    }
}