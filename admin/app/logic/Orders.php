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

namespace app\logic;


class Orders extends BaseLogic
{

    /**
     *
     * 获取订单列表
     *
     * @author 勇敢的小笨羊
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int $paginate
     * @return mixed
     */
    public function getOrderList($where = [], $field = true, $order = '', $paginate = 20)
    {
        return $this->modelOrders->getList($where, $field, $order, $paginate);
    }
}