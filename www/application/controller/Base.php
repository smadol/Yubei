<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\controller;

use app\model\Notice;
use app\service\UserService;
use think\Controller;

class Base extends Controller
{
    protected $userInfo = null;

    /**
     * Base constructor.
     * @throws \think\exception\DbException
     */
    public function __construct(){
        parent::__construct();
        if( !$this->userInfo = UserService::info() ){
            $this->redirect("/login");
        }
        $this->assign('userinfo',$this->userInfo);
        $this->assign('notice',$this->getNotice());
        $this->assign('qrcode',$this->getUserApiCode());

    }

    /**
     * 获取公告列表
     * @author 勇敢的小笨羊
     * @return Notice[]|false|mixed
     * @throws \think\exception\DbException
     */
    public function getNotice(){
        if($notice = cache('notice')){
            return $notice;
        }else{
            $notice = Notice::all(['status'=>1]);
            cache('notice',$notice);
            return $notice;
        }
    }

    /**
     * 获取一码付地址
     * @author 勇敢的小笨羊
     * @return string
     */
    public function getUserApiCode()
    {
        return "https://www.98imo.com/assets/qr-pub.jpg";
    }
}