<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\controller;


use app\service\UserService;

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

    /**
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        //是否post
        if ($this->request->isAjax()){
            return $this->service->changeInfo($this->request->post());
        }else {
            $this->assign('user',UserService::info());
            return $this->fetch();
        }
    }

    /**
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function security()
    {
        //是否post
        if ($this->request->isPost()){
            return $this->service->changeApi($this->request->post());
        }else {
            $this->assign('api', UserService::api());
            return $this->fetch();
        }
    }

}