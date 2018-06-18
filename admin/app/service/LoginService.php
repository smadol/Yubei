<?php
namespace app\service;
use think\Request,
	think\Session,
	app\model\User;

class LoginService
{

    /**
     * 登录逻辑处理
     * @author 勇敢的小笨羊
     * @return array
     * @throws \think\exception\DbException
     */
    public function login(){
    	Request::instance()->isPost() || die('request not  post!');
    	
    	//获取参数
		$param = Request::instance()->post();
    	$user  = User::get(['username' => $param['username'] ]);

    	//检测用户是否存在
    	if( is_null($user) ){
    		return [
    			'error'	=>	100,
    			'msg'	=>	'用户名不存在'
    		];
    	}

    	//检测密码是否正确
    	if( $user['password'] != md5($param['password']) ){
    		return [
    			'error'	=>	100,
    			'msg'	=>	'用户名或者密码错误'
    		];	
    	}else{
            Session::set('uid',$user->id,'admin');
    		return [
    			'error'	=>	0,
    			'msg'	=>	'登录成功'
    		];	

    	}
    }

    //注销
    public function quit(){
        Session::delete('uid','think');
        Session::delete('company','think');
    }    


}
