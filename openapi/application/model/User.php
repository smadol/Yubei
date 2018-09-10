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


class User extends BaseModel
{

    /**
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $uid
     * @return User|bool|null
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