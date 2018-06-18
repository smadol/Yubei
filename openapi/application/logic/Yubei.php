<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\logic;

use app\model\Api;

class Yubei
{
    /**
     * 默认返回资源类型
     * @var string
     */
    protected static $restDefaultType = 'json';
    /**
     * 支付路由
     * @var string
     */
    public static $uri = 'http://api.yubei.cn/pay/unifiedorder';

    /**
     * 查出来的商户KEY
     * @var null
     */
    protected static $secretKey = null;

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
     * 查找商户secretKey
     * @param $uid
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected static function getMchSecretKey($uid){
        //取出用户KEY 进行对比加密
        $secretKey =(new Api())
            ->where(['uid'=>$uid])
            ->field('key')
            ->find()->toArray()['key'];
        self::$secretKey = $secretKey;
    }

}