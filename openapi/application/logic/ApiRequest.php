<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\logic;
use app\library\exception\ForbiddenException;
use app\library\exception\SignatureException;

/**
 * 请求数据处理
 * Class ApiRequest
 * @package app\api\logic
 */
class ApiRequest extends Yubei
{
    /**
     * 静态变量保存全局的实例
     * @var null
     */
    private static $_instance = null;

    /**
     * @var null
     */
    protected static $requestHeader = [
        'authentication' => 'this is a false auth',
        'signature' => 'this is a false signature',
        'timestamp' => 'this is a false timestamp',
        'noncestr' => 'this is a false noncestr'
    ];

    /**
     * 私有的构造方法
     */
    private function __construct() {

    }

    /**
     * 静态方法 单例模式统一入口
     * @param $requestHeader
     * @return ApiRequest|null
     * @throws ForbiddenException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getInstance($requestHeader=null) {
        if(is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        if(!is_null($requestHeader)) {
            self::$requestHeader = $requestHeader;
        }
        if (empty(self::$requestHeader['authentication'])){
            throw new ForbiddenException(['msg'=>'Invalid Request.[Request Authentication Not Found.]']);
        }
        //取出用户KEY 进行对比加密
        self::getMchSecretKey(self::$requestHeader['authentication']);
        return self::$_instance;
    }

    /**
     *  商户传入数据验签[商户公钥验签]
     * @param $request
     * @throws ForbiddenException
     * @throws SignatureException
     */
    public static function verify($request)
    {
        $_cur_uri = $_cur_uri_query_string = stristr(self::$uri,'/pay/');
        $_query_string = $_query_string_index = strpos($_cur_uri_query_string,'?');
        if (!empty($_query_string_index)){
            $_cur_uri = substr($_cur_uri_query_string,0,$_query_string_index);//uri
            $_query_string = substr($_cur_uri_query_string,$_query_string_index+1);//query string
        }
        $_to_verify_data = utf8_encode($_cur_uri)
                        ."\n".utf8_encode($_query_string)
                        ."\n".utf8_encode(self::$requestHeader['noncestr'])
                        ."\n".utf8_encode(self::$requestHeader['timestamp'])
                        ."\n".utf8_encode(self::$secretKey)
                        ."\n".utf8_encode($request);
        if(empty(self::$requestHeader['signature'])){
            throw new SignatureException(['msg'=>'Invalid Request.[Request header[signature] Failure.]']);
        }
        //验签
        $verify_result = Encryption::to_verify_data($_to_verify_data, self::$requestHeader['signature']);
        if(empty($verify_result) || intval($verify_result)!=1){
            throw new ForbiddenException(['msg'=>'Invalid Request.[Request Data And Sign Verify Failure.]']);
        }
        if ((float)self::getMicroTime() - (float)self::$requestHeader['timestamp'] >= 2*60*1000){
            throw new ForbiddenException(['msg'=>'Invalid Request.[Request Time Is Invalid.]']);
        }
    }
}