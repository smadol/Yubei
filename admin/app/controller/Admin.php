<?php
/**
 *  +---------------------------------------------------------------------+
 *  | Yubei      | [ WE CAN DO IT JUST THINK ]
 *  +---------------------------------------------------------------------+
 *  | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )
 *  +---------------------------------------------------------------------+
 *  | Author     | Brian Waring <BrianWaring98@gmail.com>
 *  +---------------------------------------------------------------------+
 *  | Company    | 小红帽科技      <Iredcap. Inc.>
 *  +---------------------------------------------------------------------+
 *  | Repository | https://github.com/BrianWaring/Yubei
 *  +---------------------------------------------------------------------+
 */

namespace app\controller;


class Admin extends Base
{
    /**
     * 获取管理员信息
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     */
    public function profile(){
        $this->assign('info',$this->logicAdmin->getAdminInfo(['id' =>is_login()]));
        return $this->fetch();
    }

}