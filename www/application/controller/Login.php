<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\controller;

use app\service\UserService;
use think\Controller;
use think\Session;

class Login extends Controller
{
    /**
     *
     * @var UserService
     */
    protected $service;

    /**
     * Login constructor.
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * @return mixed|\think\response\Json
     * @throws \think\exception\DbException
     */
    public function index()
    {
        if(\session('user_id') ){
            $this->redirect("/");
        }
        //是否post
        if ($this->request->isPost()){
            return $this->service->login($this->request->post());
        }else{
            return $this->fetch();
        }
    }

    /**
     *
     */
    public function quit()
    {
        session('user_id',null);
        cache('user',null);
        $this->redirect("/login");

    }
}