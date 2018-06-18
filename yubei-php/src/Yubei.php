<?php

namespace Yubei;

class Yubei
{
    const CAHRSET = 'utf-8';
    /**
     * $var string The Yubei API version
     */
    public static $version = '1.0.0';

    /**
     * @var string The base URL for the Yubei unifiedorder.
     */
    public static $baseUrl = 'http://api.yubei.cn/pay/unifiedorder';

    /**
     * @var string The base URL for the Yubei orderquery.
     */
    public static $queryUrl = 'http://api.yubei.cn/pay/orderquery';

    /**
     * @var string The Yubei mch ID
     */
    private static $mchId = null;

    /**
     * @var string The Yubei notifyUrl
     */
    private static $notifyUrl = null;

    /**
     * @var string The Yubei returnUrl
     */
    private static $returnUrl = null;

    /**
     * @var string SecretKey
     */
    private static $secretKey = null;

    /**
     * @var
     */
    private static $publicKeyPath = null;

    /**
     * @var null The Yubei privateKeyPath
     */
    private static $privateKeyPath = null;

    /**
     * @var null The Yubei privateKeyPath
     */
    private static $YubeiPublicKeyPath = null;

    /**
     * @return string
     */
    public static function getMchId()
    {
        return self::$mchId;
    }

    /**
     * @param string $mchId
     */
    public static function setMchId($mchId)
    {
        self::$mchId = $mchId;
    }

    /**
     * @return string
     */
    public static function getNotifyUrl()
    {
        return self::$notifyUrl;
    }

    /**
     * @param string $notifyUrl
     */
    public static function setNotifyUrl($notifyUrl)
    {
        self::$notifyUrl = $notifyUrl;
    }

    /**
     * @return string
     */
    public static function getReturnUrl()
    {
        return self::$returnUrl;
    }

    /**
     * @param string $returnUrl
     */
    public static function setReturnUrl($returnUrl)
    {
        self::$returnUrl = $returnUrl;
    }

    /**
     * @return null|string
     */
    public static function getApiVersion()
    {
        return self::$version;
    }

    /**
     * @param null|string $apiVersion
     */
    public static function setApiVersion($apiVersion)
    {
        self::$version = $apiVersion;
    }

    /**
     * @return string
     */
    public static function getSecretKey()
    {
        return self::$secretKey;
    }


    /**
     * @param string $secretKey
     */
    public static function setSecretKey($secretKey)
    {
        self::$secretKey = $secretKey;
    }

    /**
     * @return null
     */
    public static function getPrivateKeyPath()
    {
        return self::$privateKeyPath;
    }

    /**
     * @param null $privateKeyPath
     */
    public static function setPrivateKeyPath($privateKeyPath)
    {
        self::$privateKeyPath = $privateKeyPath;
    }

    /**
     * @return mixed
     */
    public static function getPublicKeyPath()
    {
        return self::$publicKeyPath;
    }

    /**
     * @param mixed publicKeyPath
     */
    public static function setPublicKeyPath($publicKeyPath)
    {
        self::$publicKeyPath = $publicKeyPath;
    }

    /**
     * @return null
     */
    public static function getYubeiPublicKeyPath()
    {
        return self::$YubeiPublicKeyPath;
    }

    /**
     * @param null $YubeiPublicKeyPath
     */
    public static function setYubeiPublicKeyPath($YubeiPublicKeyPath)
    {
        self::$YubeiPublicKeyPath = $YubeiPublicKeyPath;
    }



}
