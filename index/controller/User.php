<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\index\controller;


use app\index\service\UserService;

class User extends Base
{
    protected $service;

    /**
     * User constructor.
     * @param UserService $service
     * @throws \think\exception\DbException
     */
    public function __construct(UserService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function index()
    {
        $userinfo = $this->service->info($this->userInfo['mchid']);
        $this->assign('user',$userinfo);
        return $this->fetch();
    }


    public function security()
    {
        return $this->fetch();
    }
}