<?php
/**
 * Author: Single Dog
 * Github: https://github.com/SingleSheep
 * Date: 2018/2/6 - 20:00
 */

namespace app\logic;
use app\library\exception\ParameterException;
use app\library\exception\OrderException;
use app\library\exception\UserException;

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
     * @author 勇敢的小笨羊
     * @param $orderData
     * @return mixed
     * @throws OrderException
     * @throws ParameterException
     * @throws UserException
     */
    public function pay($orderData){
        // 验证
        $this->validateGateway->gocheck();
        // 是否重复订单
        if(!is_null($orderData)){
            //唯一订单号校验
            $order = $this->modelOrders->getOutTradeOrder($orderData['out_trade_no']);
            if ($order){
                //存在订单 抛出异常
                throw new OrderException([
                    'msg'   =>  'Repeat Order Number.'
                ]);
            }
            //用户是否存在
            $User = $this->modelUser->getUser($orderData['mchid']);
            if ($User && $User['status'] !== 1){
                throw new UserException(['msg'=>'Merchants Disable.']);
            }
            if(!$User){
                throw new UserException(['msg'=>'The Merchant Does Not Exist, Please Check The Merchant ID']);
            }
            // 添加
            return $this->modelOrders->addOrder($orderData);

        }
        throw new ParameterException([
            'msg'   => 'Error Of Order Parameter.'
        ]);
    }
}