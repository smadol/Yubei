<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\service;

use app\library\exception\ParameterException;
use app\library\Rsa;
use think\Controller;

abstract class Rest extends Controller
{
    /**
     * 请求参数
     *
     * @var array
     */
    protected static $context = [];

    /**
     * @var
     */
    protected static $conId;

    /**
     * 创建当前请求上下文
     *
     * @author 勇敢的小笨羊
     * @throws ParameterException
     */
    public static function createContext(){
        $conId = self::$conId = self::createUniqid();
        if (!isset(static::$context[$conId])){
            static::$context[$conId] = [];
        }else{
            throw new ParameterException(['msg'=>'Create context failed,cannot create a duplicate context']);
        }
    }


    /**
     * 销毁当前请求上下文
     *
     * @author 勇敢的小笨羊
     * @throws ParameterException
     */
    public static function destoryContext(){
        if (isset(static::$context[self::$conId])){
            unset(static::$context[self::$conId]);
        }else{
            throw new ParameterException(['msg'=>'Destory context failed,cannot destory a duplicate context']);
        }
    }

    /**
     * 判断当前请求上下文是否存在
     * @return boolean
     */
    public static function exsits()
    {
        return isset(static::$context[self::createUniqid()]);
    }
    /**
     * 获取上下文数据
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public static function get($name, $default = null)
    {
        if(!isset(static::$context[self::$conId]))
        {
            throw new \RuntimeException('get context data failed, current context is not found');
        }
        if(isset(static::$context[self::$conId][$name]))
        {
            return static::$context[self::$conId][$name];
        }
        else
        {
            return $default;
        }
    }
    /**
     * 设置上下文数据
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public static function set($name, $value)
    {
        if(!isset(static::$context[self::$conId]))
        {
            throw new \RuntimeException('set context data failed, current context is not found');
        }
        static::$context[self::$conId][$name] = $value;
    }
    /**
     * 获取当前上下文
     * @return array
     */
    public static function getContext()
    {
        if(!isset(static::$context[self::$conId]))
        {
            throw new \RuntimeException('get context failed, current context is not found');
        }
        return static::$context[self::$conId];
    }
    /**
     * 获取当前的服务器对象
     */
    public static function getServer()
    {
        return static::get('request')->getServerInstance();
    }

    /**
     * 在当前服务器上下文中获取Bean对象
     * @param string $name
     * @return mixed
     */
    public static function getBean($name, &$params)
    {
        return static::getServer()->getBean($name, $params);
    }

    /**
     * 获取当前时间的毫秒数
     * @return float
     */
    public static function getMicroTime(){
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
    }

    /**
     * 生成唯一id[32位]
     *
     * @param string $namespace
     * @return string
     */
    public static function createUniqid($namespace = ''){
        static $uniqid = '';
        $uid = uniqid("", true);
        $data = $namespace;
        $data .= isset($_SERVER['REQUEST_TIME']) ? $_SERVER['REQUEST_TIME'] : "";
        $data .= isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";
        $data .= isset($_SERVER['LOCAL_ADDR']) ? $_SERVER['LOCAL_ADDR'] : "";
        $data .= isset($_SERVER['LOCAL_PORT']) ? $_SERVER['LOCAL_PORT'] : "";
        $data .= isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : "";
        $data .= isset($_SERVER['REMOTE_PORT']) ? $_SERVER['REMOTE_PORT'] : "";
        $hash = strtoupper(hash('ripemd128', $uid . $uniqid . md5($data)));
        $uniqid = substr($hash,  0,  8) .
            substr($hash,  8,  4) .
            substr($hash, 12,  4) .
            substr($hash, 16,  4) .
            substr($hash, 20, 12);
        return $uniqid;
    }

    /**
     * 生成签名字符串
     * @author 勇敢的小笨羊
     * @param $to_sign_data
     * @return string
     */
    protected static function sign($to_sign_data){
        $Rsa = new Rsa();
        $Rsa->_setPrivateKey(CRET_PATH . 'yubei_rsa_private_key.pem');
        return $Rsa->sign($to_sign_data);
    }

    /**
     * 数据验签
     * @author 勇敢的小笨羊
     * @param $data
     * @param $sign
     * @param $uid
     * @return bool
     */
    protected static function verify($data, $sign, $uid){
        $Rsa = new Rsa();
        $Rsa->_setPublicKey(CRET_PATH . $uid . DS .'rsa_public_key.pem');
        return $Rsa->verify($data, $sign, $code = 'base64');
    }
}