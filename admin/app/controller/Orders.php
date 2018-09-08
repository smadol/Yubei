<?php
namespace app\controller;

class Orders extends Base
{

    public function index(){

        $this->assign('list', $this->logicOrders->getOrderList());

        return $this->fetch();
    }

}
