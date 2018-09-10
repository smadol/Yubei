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

namespace app\logic;


class Login extends BaseLogic
{

    /**
     * 登录操作
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $username
     * @param $password
     * @param $verify
     * @return array
     */
    public function dologin($username,$password,$verify){

         $validate = $this->validateLogin->check(compact('username','password','verify'));

         if (!$validate) {

             return [0, $this->validateLogin->getError()];
         }

        $admin = $this->logicAdmin->getAdminInfo(['username' => $username]);

        if (!empty($admin['password']) && data_md5_key($password) == $admin['password']) {

            $this->logicAdmin->setAdminValue(['id' => $admin['id']], 'update_time', time());

            $auth = ['id' => $admin['id'], 'update_time'  =>  time()];

            session('admin_info', $admin);
            session('admin_auth', $auth);
            session('admin_auth_sign', data_auth_sign($auth));

            return [ 1, '登录成功'];

        } else {

            return [ 0, empty($admin['id']) ? '用户账号不存在' : '密码输入错误'];
        }
    }

    /**
     * 注销当前用户
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return array
     */
    public function logout()
    {

        clear_login_session();

        return [1, '注销成功'];
    }

    /**
     * 清理缓存
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return array
     */
    public function clearCache()
    {

        \think\Cache::clear();

        return [ 1,  '清理成功'];
    }
}