<?php
/**
 * Created by 小羊.
 * Author: 勇敢的小笨羊
 * 微博: http://weibo.com/xuzuxing
 * Date: 2018/3/8
 * Time: 19:34
 */

namespace app\model;


class Asset extends BaseModel
{

    /**
     * @author 勇敢的小笨羊
     * @param $uid
     * @param $amount
     * @return int|true
     * @throws \think\Exception
     */
    public static function IncDis($uid,$amount){
       return self::where(['uid'=>$uid])->setInc('disable',$amount);
    }
}