<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\controller;


class Menu extends Base
{
    public function index()
    {
        $this->assign('menu',$this->logicMenu->getAll());
        return $this->fetch();
    }

    /**
     * 菜单添加
     */
    public function add()
    {
        // post 是提交数据
        $this->request->isPost() && $this->success($this->logicMenu->addMenu($this->request->post()));
        // 列出父级
        $this->assign('father',$this->logicMenu->getFather());
        return $this->fetch('edit');
    }

    /**
     * 菜单编辑
     */
    public function edit()
    {
        //提交数据
        $this->request->isPost() && $this->success($this->logicMenu->menuEdit($this->request->post()));
        // 获取此菜单数据
        $this->assign('menu', $this->logicMenu->getMenuInfo($this->request->param('id')));
        // 列出父级
        $this->assign('father',$this->logicMenu->getFather());

        return $this->fetch('edit');
    }
}