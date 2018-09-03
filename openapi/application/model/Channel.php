<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\model;

use think\Cache;
use think\Log;

class Channel extends BaseModel
{

    /**
     * 获取支付渠道
     * @author 勇敢的小笨羊
     * @param $Cnel
     * @return mixed
     */
    public static function getChannel($Cnel){
        //获取缓存支付渠道数据
        $appChannelMap = Cache::get($Cnel);
        //判断存在性
        if (!$appChannelMap){
            Log::record("appChannelMap Cache Expire Out.");
            //获取渠道sn
            $appChannelMap = self::where(['name'=>$Cnel,'status'=> 1])->column('param');
            Log::record($Cnel.':'.json_encode($appChannelMap));
            //缓存所有该支付渠道下的所有支付账户数据  2小时
            Cache::set($Cnel,$appChannelMap,'7200');
            $Channel = $appChannelMap[rand(0,count($appChannelMap)-1)];
        }else {
            $Channel = $appChannelMap[rand(0,count($appChannelMap)-1)];
        }
        return json_decode($Channel,true);
    }

}