<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\service;
use app\model\AssetSettle;
use think\Request;

class SettleService
{
    /**
     * 提现记录
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
        empty($data['assets_no'])|| $where['assets_no']		= 	['like','%'.$data['assets_no'] ];

        return AssetSettle::where($where)->order('create_time desc')->paginate(10);
    }

}