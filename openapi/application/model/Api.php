<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\model;
use think\Cache;

class Api extends Base
{

    /**
     * 获取所有Key
     *
     * @author 勇敢的小笨羊
     * @return array
     */
    public static function appKeyMap(){
        if (!$appKeyMap = Cache::get('appKeyList')){
            $appKeyMap = self::column('key');
            //缓存AppKey  2小时
            Cache::set('appKeyMap',$appKeyMap,'7200');
        }
        return $appKeyMap;
    }
}