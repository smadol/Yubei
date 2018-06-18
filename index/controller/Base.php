<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\index\controller;

use app\common\model\User;
use think\Controller;
use think\Session;

class Base extends Controller
{
    protected $userInfo = null;
    /**
     * Base constructor.
     * @throws \think\exception\DbException
     */
    public function __construct(){
        parent::__construct();
        if( !Session::get('uid','user') ){
            $this->redirect("/login");
        }
        $user_info = User::get(['mchid' => Session::get('uid','user') ]);
        $this->userInfo = $user_info;
        $this->assign('userinfo',$user_info);

    }
}