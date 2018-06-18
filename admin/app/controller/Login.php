<?php
namespace app\controller;
use think\Controller,
    app\service\LoginService;

class Login extends Controller
{

    protected $service;
    public function __construct(LoginService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * 登录页面
     * @author 勇敢的小笨羊
     * @return mixed
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 登陆操作
     * @author 勇敢的小笨羊
     * @return array
     * @throws \think\exception\DbException
     */
    public function login()
    {
        return $this->service->login();
    }

    /**
     * 退出
     * @author 勇敢的小笨羊
     */
    public function quit()
    {
        $this->service->quit();
        return $this->redirect("Login/index"); 
    }

}
