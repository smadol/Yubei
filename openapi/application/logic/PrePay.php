<?php
/**
 * +---------------------------------------------------------------------+
 * | Yubei      | [ WE CAN DO IT JUST THINK ]
 * +---------------------------------------------------------------------+
 * | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )
 * +---------------------------------------------------------------------+
 * | Author     | Brian Waring <BrianWaring98@gmail.com>
 * +---------------------------------------------------------------------+
 * | Company    | 小红帽科技      <Iredcap. Inc.>
 * +---------------------------------------------------------------------+
 * | Repository | https://github.com/BrianWaring/Yubei
 * +---------------------------------------------------------------------+
 */
namespace app\logic;
use app\library\exception\ParameterException;
use app\library\exception\OrderException;
use app\library\exception\UserException;

/**
 * 下单处理
 *
 * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
 *
 */
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
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $orderData
     * @return mixed
     * @throws OrderException
     * @throws ParameterException
     * @throws UserException
     */
    public function orderPay($orderData){
        //TODO 验证支付数据
        $this->validateUnifiedorder->gocheck();
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
            //TODO 订单持久化（估计用到队列）并提交支付
            return $this->modelOrders->addOrder($orderData);

        }
        throw new ParameterException([
            'msg'   => 'Error Of Order Parameter.'
        ]);
    }

    /**
     * 查询订单
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $queryData
     */
    public function orderQuery($queryData){
        // 验证
        $this->validateQueryorder->gocheck();
    }
}