<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\model;
use think\Cache;
use think\Log;

class Api extends BaseModel
{

    /**
     * 获取所有Key
     *
     * @author 勇敢的小笨羊
     * @return array|mixed
     */
    public static function appKeyMap(){
        if (!Cache::get('appKeyMap')){
            Log::record("appKeyMap Cache Expire Out.");
            $appKeyMap = self::column('key');
            //缓存AppKey  2小时
            Cache::set('appKeyMap',$appKeyMap,'7200');
            return $appKeyMap;
        }else{
            return Cache::get('appKeyMap');
        }
    }
}