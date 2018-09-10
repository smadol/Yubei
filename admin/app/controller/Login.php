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


class Login extends Common
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
        is_login() && $this->redirect(url('index/index'));

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
     */
    public function login($username = '', $password = '', $verify = '')
    {
        $this->result($this->logicLogin->dologin($username, $password, $verify));

    }

    /**
     * 注销登录
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     */
    public function logout()
    {
        $this->result($this->logicLogin->logout());
    }

    /**
     * 清理缓存
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     */
    public function clearCache()
    {
        $this->result($this->logicLogin->clearCache());
    }
}
