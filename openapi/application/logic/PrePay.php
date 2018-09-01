<?php
/**
 * Author: Single Dog
 * Github: https://github.com/SingleSheep
 * Date: 2018/2/6 - 20:00
 */

namespace app\logic;

class PrePay extends BaseLogic
{
    /**
     * 1.构建支付订单
     * 2.请求支付对象并返回商户
     * 3.用户扫码完成支付
     * 4.订单队列处理异步回调
     * 5.完成订单
     *
     * 构建支付订单
     */
    public function pay($orderData){
        // 验证
        $this->validateGateway->gocheck();
        // 添加
        return $this->modelOrders->addOrder($orderData);

    }
}