<?php
/**
 * +---------------------------------------------------------------------+
 * | Yubei      | [ WE CAN DO IT JUST THINK ]
 * +---------------------------------------------------------------------+
 * | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )
 * +---------------------------------------------------------------------+
 * | Author     | Brian Waring <BrianWaring98@gmail.com>
 * +---------------------------------------------------------------------+
 * | Company    | 小红帽科技      <Iredcap. Inc.>
 * +---------------------------------------------------------------------+
 * | Repository | https://github.com/BrianWaring/Yubei
 * +---------------------------------------------------------------------+
 */
namespace app\service\response;

use think\Log;

class BuildEncrypt extends ApiSend
{

    /**
     * 构建签名时间戳与随机字符串
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $chargeRespose
     * @return mixed|void
     */
    public function doBuild($chargeRespose)
    {
        //记录本次上下文数据
        static::set('noncestr',$noncestr  =  self::createUniqid());
        static::set('timestamp',$timestamp =  self::getMicroTime());
        // 日志记录
        Log::notice('Sign Noncestr:'.$noncestr.'Sign Timestamp:'.$timestamp);
    }

}