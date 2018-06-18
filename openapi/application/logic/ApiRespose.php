<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\logic;
use think\exception\HttpResponseException;
use think\Response;

/**
 * API响应
 * Class ApiRespose
 * @package app\api\logic
 */
class ApiRespose extends Yubei
{

    /**
     * 静态变量保存全局的实例
     * @var null
     */
    private static $_instance = null;

    /**
     * 储存需要加密数据
     * @var
     */
    private static $encrypt;
    /**
     * 私有的构造方法
     */
    private function __construct() {

    }

    /**
     * 静态方法 单例模式统一入口
     * @param string $restDefaultType  返回数据类型
     * @return ApiRespose|null
     */
    public static function getInstance($restDefaultType = null) {
        if(is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        if(!is_null($restDefaultType)) {
            self::$restDefaultType = $restDefaultType;
        }
        self::$encrypt = array(
            "noncestr"=>self::createUniqid(),
            "timestamp"=>self::getMicroTime(),
        );

        return self::$_instance;
    }

    /**
     * 平台传输数据签名
     *
     * @param $body_data
     * @return string
     */
    public static function sign($body_data){
        $_to_sign_data = utf8_encode(self::$encrypt['noncestr'])
                    ."\n" . utf8_encode(self::$encrypt['timestamp'])
                    ."\n" . utf8_encode(self::$secretKey)
                    ."\n" . utf8_encode($body_data);
        return Encryption::encrypt($_to_sign_data);
    }

    /**
     * 如果需要允许跨域请求，请在记录处理跨域options请求问题，并且返回200，以便后续请求，这里需要返回几个头部。。
     * @param array $data 返回信息
     * @param int $code 状态码
     * @param string $msg 返回信息
     * @param array $header 返回头部信息
     */
    public function returnmsg($data = [],$code = 200, $msg = 'SUCCESS',$header = [])
    {
        http_response_code($code);    //设置返回头部
        $return['result_code'] = (int)$code;
        $return['result_msg'] = $msg;
        if ($code==200){
            $return['charge'] = $data;
        }
        // 发送头部信息
        foreach ($header as $name => $val) {
            if (is_null($val)) {
                header($name);
            } else {
                header($name . ':' . $val);
            }
        }
        //签名及数据返回
        header('noncestr:'.self::$encrypt['noncestr']);
        header('timestamp:'.self::$encrypt['timestamp']);
        header('signature:'.ApiRespose::sign(json_encode($return)));
        $response = Response::create(json_encode($return), JSON_UNESCAPED_UNICODE)->header($header);
        throw new HttpResponseException($response);
    }
}