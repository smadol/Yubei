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
     *
     * @author 勇敢的小笨羊
     * @param string $Cnel 支付渠道 WXPAY ALIPAY QQPAY
     * @return mixed
     * @throws \think\exception\DbException
     */
    public static function getChannel($Cnel){
        //获取缓存支付渠道数据
        $appChannelMap = Cache::get('appChannelMap-'.$Cnel); //appChannelMap:["800","801","802","903","904"]
        //判断存在性
        if (!$appChannelMap){
            Log::record("appChannelMap Cache Expire Out.");
            //获取渠道sn
            $appChannelMap = self::where(['channel'=>$Cnel,'status'=> 1])->column('sn');
            Log::record('appChannelMap:'.json_encode($appChannelMap));
            //缓存所有该支付渠道下的所有支付通道SN  12小时
            Cache::set('appChannelMap-'.$Cnel,$appChannelMap,'7200');
            $ChId = $appChannelMap[rand(0,count($appChannelMap)-1)];
        }else {
            $ChId = $appChannelMap[rand(0,count($appChannelMap)-1)];
        }
        $Channel = self::get(['sn'=>$ChId]);
        return json_decode($Channel['param'],true);
    }

}