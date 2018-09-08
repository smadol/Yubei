<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\logic;


class Menu extends BaseLogic
{
    public function getFather(){
        return $this->modelAdminMenu->getColumn([
            'status'	=>	1,
            'level'		=>	0
        ]);
    }

    public function getChild(){
        return $this->modelAdminMenu->getColumn([
            'status'	=>	1,
            'level'		=>	['>',0]
        ]);
    }

    public function getMenu($ids){
        return [
            'father'    =>  $this->modelAdminMenu->getColumn([
                'status'    =>  0,
                'level'     =>  0,
                'id'        =>  ['in',"$ids"]
            ]),
            'child'     =>  $this->modelAdminMenu->getColumn([
                'status'    =>  0,
                'level'     =>  ['>',0],
                'id'        =>  ['in',"$ids"]
            ])
        ];
    }

    public function getMenuAll(){
        return [
            'father'    =>  $this->modelAdminMenu->getColumn([
                'status'    =>  1,
                'level'     =>  0
            ]),
            'child'     =>  $this->modelAdminMenu->getColumn([
                'status'    =>  1,
                'level'     =>  ['>',0]
            ])
        ];
    }

    public function getAll(){
        return $this->modelAdminMenu->getList([], $field = true, $order = '', $paginate = 50);
    }

    public function addMenu($data){
        //添加菜单
        $result = $this->modelAdminMenu->setInfo($data);

        return $result ? [1, '菜单添加成功'] : [0, $this->modelMenu->getError()];

    }

    public function getMenuInfo($id){
        return $this->modelAdminMenu->getInfo([
            'id'    =>  $id
        ]);
    }

    public function getMenuShow($user){
        if( $user == '1' ){
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