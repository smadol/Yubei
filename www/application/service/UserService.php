<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\service;

use app\model\Api;
use app\model\User;
use app\validate\LoginValidate;
use app\validate\ReginValidate;

class UserService
{


    /**
     * 获取商户信息
     * @return User|null
     * @throws \think\exception\DbException
     */
    public static function info(){
        if($user = cache('user')){
            return $user;
        }else{
            $user = User::get(['uid'=>session('user_id')]);
            cache('user',$user);
            return $user;
        }
    }

    public function changeInfo($data){
        $res = (new User())->where(['uid'=>session('user_id')])->update($data);
        if( !$res ){
            return result(101,'修改商户信息失败，请稍后重试...');
        }else{
            return result(0,'修改成功');

        }
    }
    /**
     * 获取商户API信息
     * @return Api|null
     * @throws \think\exception\DbException
     */
    public static function api(){
        $api = Api::get(['uid'=>session('user_id')]);
        return $api;
    }

    public function changeApi($data){
        $res = Api::update([
            'key'=>md5($data['rsakey']),'secretkey'=>$data['rsakey']
        ], ['uid'=>session('user_id')]);
        if( !$res ){
            return result(101,'修改商户KEY失败，请稍后重试...');
        }else{
            return result(0,'修改成功');

        }
    }
    /**
     * @param $data
     * @return \think\response\Json
     * @throws \think\exception\DbException
     */
    public function login($data){

        //参数校验
        $validate = new LoginValidate();
        if(!$validate->check($data)){
            return result(100,$validate->getError());
        }
        //模型
        $user  = User::get(['username' => $data['username'] ]);

        //检测用户是否存在
        if( is_null($user) ){
            return result(100,'商户不存在');
        }
        //检测用户是否禁用
        if( $user->status == 0 ){
            return result(100,'商户禁用');
        }
        //检测密码是否正确
        if( $user['password'] != xmd5($data['password']) ){
            return result(101,'商户邮箱或者密码错误');
        }else{
            session('user_id',$user->uid);
            return result(0,'登陆成功');

        }
    }
    public function register($data){
        //参数校验
        $validate = new ReginValidate();
        if(!$validate->check($data)){
            return result(100,$validate->getError());
        }
    }
}