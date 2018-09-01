<?php
/**
 * Created by 小羊.
 * Author: 勇敢的小笨羊
 * 微博: http://weibo.com/xuzuxing
 * Date: 2018/3/18
 * Time: 14:53
 */

namespace app\controller;

use app\service\ApiRespose;
use app\library\exception\ForbiddenException;


/**
 * 所有的支付操作，都需要对输入执行参数校验，避免接口受到攻击。
　　● 验证输入参数中各字段的有效性验证，比如用户ID,商户ID,价格，返回地址等参数。
　　● 验证账户状态。交易主体、交易对手等账户的状态是处于可交易的状态。
　　● 验证订单：如果涉及到预单，还需要验证订单号的有效性，订单状态是未支付。为了避免用户缓存某个URL地址，还需要校验下单时间和支付时间是否超过预定的间隔。
　　● 验证签名。签名也是为了防止支付接口被伪造。 一般签名是使用分发给商户的key来对输入参数拼接成的字符串做MD5 Hash或者RSA加密，然后作为一个参数随其他参数一起提交到服务器端。
 * @package app\api\controller
 */
class Gateway extends BaseController
{

    /**
     * @throws ForbiddenException
     */
    public function gateway(){
        throw new ForbiddenException();
    }

    /**
     * 统一扫码支付
     * @author 勇敢的小笨羊
     */
    public function unifiedorder(){
        //传入预支付订单信息 => 支付对象返回
        ApiRespose::send($this->logicPrePay->pay($this->request->post()));
    }

}