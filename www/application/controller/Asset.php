<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\controller;

use app\service\VerificationCode;
use app\service\AssetService;

class Asset extends Base
{
    /**
     * @var AssetService
     */
    protected $service;

    /**
     * Settle constructor.
     * @param AssetService $service
     * @throws \think\exception\DbException
     */
    public function __construct(AssetService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * 资金变动记录
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $this->assign(['list'  =>  $this->service->page()]);
        return $this->fetch();
    }

    /**
     * 获取结算账户列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function account()
    {
        $this->assign(['list'  =>  $this->service->account()]);
        return $this->fetch();
    }

    /**
     * 添加提现账户
     * @return mixed
     */
    public function addAccount(){
        if ($this->request->isAjax()){
            return $this->service->addaccount($this->request->post());
        }else{
            return $this->fetch();
        }
    }

    /**
     * 取现列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function cash(){
        $this->assign(['list'  =>  $this->service->cash()]);
        return $this->fetch();
    }
    /**
     * 提现申请
     * @return mixed|\think\response\Json
     * @throws \think\exception\DbException
     */
    public function apply()
    {
        if ($this->request->isAjax()){
            $data = $this->request->post();
            //验证验证码
            $res = VerificationCode::getInstance('SMS')->valid($this->userInfo['phone'], $data['code']);
            if (!$res) {
                return result(0,'验证失败,验证码错误！',$res);
            }
            return $this->service->save($data);

        }else{
            $this->assign(['account'  =>  (new AssetService())->account()]);
            $this->assign(['asset'  =>  (new AssetService())->detail()]);
            return $this->fetch();
        }
    }

    /**
     * 发送验证码
     * @return \think\response\Json
     */
    public function sendSmsCode()
    {
        $res = VerificationCode::getInstance('SMS')->send($this->userInfo['phone']);
        if ($res->Message !== 'OK') {
            return result(0,'发送失败，请稍后重试',$res);
        }
        return result(1,'发送成功！',$res);
    }
}