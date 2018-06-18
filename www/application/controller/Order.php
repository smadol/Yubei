<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\controller;


use app\model\PayOrder;
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
     * @throws \think\exception\DbException
     */
    public function __construct(OrderService $service)
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
        $this->assign(['list'  =>  $this->service->page()]);
        return $this->fetch();
    }

    /**
     * 下载最近一个月的订单列表
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function excel() {

        $name='支付订单表';
        //列标题
        $header=['ID','订单号','支付项目','支付Body','支付渠道','支付金额','订单状态','创建时间','修改时间'];
        //重构数据
        //获取数据源
        $data = (new PayOrder())
            ->where(['uid'=>session('user_id')])
            ->whereTime('create_time', 'month')->select();

        $newdata = [];
        foreach ($data as $k => $v){
            $newdata[$k]['id']=$v['id'];
            $newdata[$k]['out_trade_no']=$v['out_trade_no'];
            $newdata[$k]['subject']=$v['subject'];
            $newdata[$k]['body']=$v['body'];
            $newdata[$k]['channel']=$v['channel'];
            $newdata[$k]['amount']=$v['amount'];
            $newdata[$k]['status']=$v['status'] == 1 ? '待支付':'已支付';
            $newdata[$k]['create_time']=$v['create_time'];
            $newdata[$k]['update_time']=$v['update_time'];
        }

        //halt($newdata);
        //公共函数
        excelExport($name,$header,$newdata);

    }

}