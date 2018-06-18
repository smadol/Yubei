<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\service;


use app\model\PayOrder;
use think\Request;


class OrderService
{
    /**
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function page(){

        $data 	= Request::instance()->get();
        $where 	= [];
        //接收时间
        if (!empty($data['time'])){
            $time = explode("/",$data['time']);
            $where['create_time'] = [ 'between', [strtotime($time['0']), strtotime($time['1'])] ];
        }
        //商户UID查询
        $where['uid']   = session('user_id');

        //封装where查询条件
        (empty($data['status']) 	|| $data['status'] == '')	|| $where['status'] 	= 	$data['status'];
        (empty($data['channel']) 	|| $data['channel'] == '')	|| $where['channel'] 	= 	$data['channel'];
        empty($data['out_trade_no'])|| $where['out_trade_no']		= 	['like','%'.$data['out_trade_no'] ];

        return PayOrder::where($where)->order('create_time desc')->paginate(10);
    }
}