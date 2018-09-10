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

namespace app\model;
use think\Cache;
use think\Log;

class Api extends BaseModel
{

    /**
     * 获取所有Key
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
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