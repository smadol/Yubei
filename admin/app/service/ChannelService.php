<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\service;

use app\model\Channel;
use think\Request;

class ChannelService
{

    public function page(){
        $data 	= Request::instance()->get();
        $where 	= [];
        //封装where查询条件
        (empty($data['sn']) 		|| $data['sn'] == '')		|| $where['sn'] 		= 	$data['sn'];
        (empty($data['status']) 	|| $data['status'] == '')	|| $where['status'] 	= 	$data['status'];
        return Channel::where($where)->paginate(15);
    }

    /**
     * 获取渠道信息
     * @author 勇敢的小笨羊
     * @param integer $id 渠道ID
     * @return Channel|null|array
     * @throws \think\exception\DbException
     */
    public function info($id){
        return Channel::get($id);
    }

    /**
     * 新增支付渠道
     * @author 勇敢的小笨羊
     * @return array
     * @throws \think\exception\DbException
     */
    public function save(){
        Request::instance()->isPost() || die('request not  post!');

        $param = Request::instance()->post();	//获取参数

        if( Channel::get(['sn' => $param['sn'] ]) ){
            return ['error'	=>	100,'msg'	=>	'渠道编号已经存在'];
        }
        //配置参数区分
        if ($param['private_key'] == $param['public_key']){
            $Jsonparam = [
                'appid' => $param['appid'],
                'key' => $param['private_key']
            ];
        }else{
            $Jsonparam = [
                'appid' =>$param['appid'],
                'private_key' =>$param['private_key'],
                'public_key'  =>$param['public_key'],
            ];
        }
        $channel 			= new Channel();
        $channel->sn 		= $param['sn'];
        $channel->channel   = $param['channel'];
        $channel->param     = json_encode($Jsonparam);
        $channel->rate      = $param['rate'];
        $channel->remark    = $param['remark'];
        $channel->status    = $param['status'];

        // 检测错误
        if( $channel->save() ){
            return ['error'	=>	0,'msg'	=>	'保存成功'];
        }else{
            return ['error'	=>	100,'msg'	=>	'保存失败'];
        }

    }

    public function update(){
        Request::instance()->isPost() || die('request not  post!');

        $param = Request::instance()->param();	//获取参数

        if ($param[''] == $param['']){
            $Jsonparam = [
                $param['appid'],
                $param['key']
                ];
        }else{
            $Jsonparam = [
                $param['appid'],
                $param['private_key'],
                $param['public_key'],
            ];
        }

        halt($Jsonparam);
        $user = Channel::get($param['id']);
        $user->sn 		= $param['sn'];
        $user->channel  = $param['channel'];
        $user->param    = json_encode($Jsonparam);
        $user->sn 		= $param['sn'];
        $user->sn 		= $param['sn'];

        // 检测错误
        if( $user->save() ){
            return ['error'	=>	0,'msg'	=>	'修改成功'];
        }else{
            return ['error'	=>	100,'msg'	=>	'修改失败'];
        }


    }
}