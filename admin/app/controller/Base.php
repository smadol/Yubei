<?php
namespace app\controller;
use think\Controller,
	think\Session,
	app\model\User,
    app\service\MenuService;

class Base extends Controller
{
	public function __construct(){
		parent::__construct();
    	if( !$uid = Session::get('uid','admin') ){
            return $this->redirect("Login/index"); 
        }
        $user_info = User::get(['id' => $uid]);

        $service = new MenuService();
        $this->assign( $service->getMenuShow($user_info) );

    }
    
}
