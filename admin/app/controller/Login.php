<?php
namespace app\controller;

class Login extends Base
{
    public function index()
    {
        //登录检测
        is_login() && $this->success( '已登录则跳过登录页', url('index/index'));

        return $this->fetch();
    }

    /**
     * 登录处理
     */
    public function login($username = '', $password = '', $verify = '')
    {
        $this->success($this->logicUser->login($username, $password, $verify));
    }

    /**
     * 注销登录
     */
    public function logout()
    {

        $this->success($this->logicUser->logout());
    }

    /**
     * 清理缓存
     */
    public function clearCache()
    {

        $this->success($this->logicUser->clearCache());
    }
}
