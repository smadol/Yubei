<?php
namespace app\controller;
use app\service\OrderService;

class Order extends Base
{
    /**
     * @var OrderService
     */
    protected $service;

    /**
     * Order constructor.
     * @param OrderService $service
     */
    public function __construct(OrderService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * 所有交易明细
     * @author 勇敢的小笨羊
     * @return mixed
     */
    public function index()
        {
        $this->assign(['list'  =>  $this->service->page()]);
        return $this->fetch();
    }

}
