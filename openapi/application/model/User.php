<?php
/**
 * Author: Single Dog
 * Github: https://github.com/SingleSheep
 * Date: 2018/2/6 - 20:05
 */

namespace app\model;


class User extends BaseModel
{

    /**
     * @author 勇敢的小笨羊
     * @param $uid
     * @return User|bool
     * @throws \think\exception\DbException
     */
    public function getUser($uid){
        $user = self::get(['uid' => $uid]);
        if ($user) {
            return $user;
        }
        return false;
    }

}