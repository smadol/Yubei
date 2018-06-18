<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\controller;

use app\service\SettleService;

class Settle extends Base
{
    /**
     * @var SettleService
     */
    protected $service;

    /**
     * Settle constructor.
     * @param SettleService $service
     * @throws \think\exception\DbException
     */
    public function __construct(SettleService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * 平台自结算记录
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $this->assign(['list'  =>  $this->service->page()]);
        return $this->fetch();
    }


}