<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\logic;


class Orders extends BaseLogic
{

    /**
     * 获取订单列表
     */
    public function getOrderList($where = [], $field = '*', $order = '', $paginate = 20)
    {
        return $this->modelOrders->getList($where, $field, $order, $paginate);
    }
}