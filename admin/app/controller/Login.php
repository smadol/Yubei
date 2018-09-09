<?php
/**
 * +---------------------------------------------------------------------+
 * | Yubei    | [ WE CAN DO IT JUST THINK ]
 * +---------------------------------------------------------------------+
 * | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )
 * +---------------------------------------------------------------------+
 * | Author     | Brian Waring <BrianWaring98@gmail.com>
 * +---------------------------------------------------------------------+
 * | Repository | https://github.com/BrianWaring/Yubei
 * +---------------------------------------------------------------------+
 */

namespace app\controller;

use think\Controller;

class Login extends Controller
{
    /**
     * 登录首页
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     */
    public function index()
    {
        //登录检测
        is_login() && $this->success( '已登录则跳过登录页', url('index/index'));

        return $this->fetch();
    }

    /**
     * 登录处理
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param string $username
     * @param string $password
     * @param string $verify
     * @return array
     */
    public function login($username = '', $password = '', $verify = '')
    {
        return (new \app\logic\Login())->dologin($username, $password, $verify);

    }

    /**
     * 注销登录
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return array
     */
    public function logout()
    {
        return (new \app\logic\Login())->logout();
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
        return (new \app\logic\Login())->clearCache();
    }
}
