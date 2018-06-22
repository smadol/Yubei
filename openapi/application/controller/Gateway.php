<?php
/**
 * Created by 小羊.
 * Author: 勇敢的小笨羊
 * 微博: http://weibo.com/xuzuxing
 * Date: 2018/3/18
 * Time: 14:53
 */

namespace app\controller;

use app\logic\ApiRespose;
use app\logic\PrePay;
use app\validate\GatewayValidate;
use app\library\exception\ForbiddenException;
use app\library\exception\OrderException;
use think\Controller;

/**
 * 所有的支付操作，都需要对输入执行参数校验，避免接口受到攻击。
　　● 验证输入参数中各字段的有效性验证，比如用户ID,商户ID,价格，返回地址等参数。
　　● 验证账户状态。交易主体、交易对手等账户的状态是处于可交易的状态。
　　● 验证订单：如果涉及到预单，还需要验证订单号的有效性，订单状态是未支付。为了避免用户缓存某个URL地址，还需要校验下单时间和支付时间是否超过预定的间隔。
　　● 验证签名。签名也是为了防止支付接口被伪造。 一般签名是使用分发给商户的key来对输入参数拼接成的字符串做MD5 Hash或者RSA加密，然后作为一个参数随其他参数一起提交到服务器端。
 * @package app\api\controller
 */
class Gateway extends Controller
{

    /**
     * @throws ForbiddenException
     */
    public function gateway(){

        throw new ForbiddenException();
    }
    /**
     * 扫码支付对象
     * @throws ForbiddenException
     * @throws OrderException
     * @throws \app\library\exception\ParameterException
     * @throws \app\library\exception\UserException
     * @throws \think\exception\DbException
     */
    public function unifiedorder(){
        $preorder = $this->request->post();
        //参数完整性
        $validate = new GatewayValidate();
        $validate->goCheck();
        //传入预支付订单信息
        $charge = PrePay::getInstance($preorder)->prepay();
        //返回支付对象
        return $this->chargeRespose($preorder,$charge);
    }

    //支付对象参数过滤
    private function chargeRespose($preorder,$charge){
        $chargeRespose = [
            'channel'=>$preorder['channel'],
            'order_no'=>$preorder['out_trade_no'],
            'client_ip'=>$preorder['client_ip'],
            'amount'=>$preorder['amount'],
            'currency'=>$preorder['currency'],
            'subject'=>$preorder['subject'],
            'body'=>$preorder['body'],
            'extra'=>$preorder['extparam'],
            'credential'=>[
                'prepay_id'=>$charge['prepay_id'],
                'order_qr'=>$charge['code_url']
            ]
        ];
        //支付对象返回
        ApiRespose::send($chargeRespose);
    }

}