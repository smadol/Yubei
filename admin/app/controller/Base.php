<?php
/**
 * +---------------------------------------------------------------------+
 * | Yubei    | [ WE CAN DO IT JUST THINK ]
 * +---------------------------------------------------------------------+
 * | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )
 * +---------------------------------------------------------------------+
 * | Author     | Brian Waring <BrianWaring98@gmail.com>
 * +---------------------------------------------------------------------+
 * | Repository | https://github.com/BrianWaring/Yubei
 * +---------------------------------------------------------------------+
 */

namespace app\controller;

use think\Request;

class Base extends Common
{

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        // 验证登录
        !is_login() && $this->redirect('login/index');
        //获取菜单
        $this->assign($this->logicMenu->getMenuShow(is_login()));

    }
    
}
