<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\service\response;

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
        //记录本次上下文数据
        static::set('noncestr',$noncestr  =  self::createUniqid());
        static::set('timestamp',$timestamp =  self::getMicroTime());
        // 日志记录
        Log::record('Sign Noncestr:'.$noncestr.'Sign Timestamp:'.$timestamp);
    }

}