<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\service;


use app\model\Customer;
use think\Request;

class CustomerService
{
    public function page(){

        $data 	= Request::instance()->get();
        $where 	= [];

        //封装where查询条件
        (empty($data['role']) 		|| $data['role'] == '')		|| $where['role'] 		= 	$data['role'];
        (empty($data['status']) 	|| $data['status'] == '')	|| $where['status'] 	= 	$data['status'];
        empty($data['truename'])	|| $where['truename']		=	[ 'like','%'.$data['truename'] ];
        empty($data['sn'])			|| $where['sn'] 			= 	$data['sn'];

        return Customer::where($where)->paginate(10);
    }
    public function info($id){
        return Customer::get(['uid'=>$id]);
    }
}