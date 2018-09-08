<?php
namespace app\service;
use app\model\AdminMenu,
    app\model\User;

class MenuService
{

    public function getFather(){
        return AdminMenu::all([
        	'status'	=>	0,
        	'level'		=>	0
        ]);
    }
  
    public function getChild(){
        return AdminMenu::all([
        	'status'	=>	0,
        	'level'		=>	['>',0]
        ]);
    }

    public function getMenu($ids){
        return [
            'father'    =>  AdminMenu::all([
                'status'    =>  0,
                'level'     =>  0,
                'id'        =>  ['in',"$ids"]
            ]),
            'child'     =>  AdminMenu::all([
                'status'    =>  0,
                'level'     =>  ['>',0],
                'id'        =>  ['in',"$ids"]
            ])
        ]; 
    }  

    public function getMenuAll(){
        return [
            'father'    =>  AdminMenu::all([
                'status'    =>  0,
                'level'     =>  0
            ]),
            'child'     =>  AdminMenu::all([
                'status'    =>  0,
                'level'     =>  ['>',0]
            ])
        ]; 
    } 

    public function getMenuShow($user){
        if( $user->id == '1' ){
            $_menuList = $this->getMenuAll();
        }else{
            $_menuList = $this->getMenu($user->findRole->ids);
        }

        return [
            '_user'   =>  $user ,
            '_menuList' =>  $_menuList
        ];
    } 


}
