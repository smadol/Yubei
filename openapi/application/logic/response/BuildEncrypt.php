<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\logic\response;


use app\logic\Encryption;
use think\Log;

class BuildEncrypt extends ApiSend
{

    /**
     * 构建签名时间戳与随机字符串
     *
     * @author 勇敢的小笨羊
     * @param array $chargeRespose 第三方返回的支付信息包
     */
    public function doBuild($chargeRespose)
    {
        $noncestr  =    self::createUniqid();
        $timestamp =    self::getMicroTime();
        //记录本次上下文数据
        static::set('noncestr',$noncestr);
        static::set('timestamp',$timestamp);
        // 日志记录
        Log::record('Sign Noncestr:'.$noncestr.'Sign Timestamp:'.$timestamp);
    }

}