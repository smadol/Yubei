<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\model;


class Asset extends Base
{

    /**
     * 获取详情
     * @return array|false|\PDOStatement|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getDetail(){
        return self::where(['uid'=>session('user_id')])->find();
    }

    /**
     * 获取可提现余额
     * @return array|false|\PDOStatement|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getAsset(){
        return self::where(['uid'=>session('user_id')])->field('asset')->find();
    }

    /**
     * 扣除XX可提现余额
     * @param $amount 扣除金额
     * @return int|true
     * @throws \think\Exception
     */
    public static function redAsset($amount){
        return self::where(['uid'=>session('user_id')])->setDec('asset',$amount);
    }
}