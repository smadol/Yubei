<?php
/**
 * Created by 小羊.
 * Author: 勇敢的小笨羊
 * 微博: http://weibo.com/xuzuxing
 * Date: 2018/3/18
 * Time: 15:12
 */

namespace app\controller;

use Yansongda\Pay\Pay;

class Notify extends BaseController
{
    /**
     * Qpay Notify
     * @author 勇敢的小笨羊
     * @return mixed
     */
    public function qqNotify()
    {
        $qpay = Pay::qpay(config('qq.qpay'));
        $this->logicNotify->handle($qpay->verify());
        return $qpay->success()->send();
    }

    /**
     * AliPay Redirect
     * @author 勇敢的小笨羊
     */
    public function aliRedirect()
    {
        $this->redirect($this->logicNotify->backBusiness());
    }

    /**
     * AliPay Notify
     * @author 勇敢的小笨羊
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Yansongda\Pay\Exceptions\InvalidSignException
     */
    public function aliNotify()
    {
        $alipay = Pay::alipay(config('ali.alipay'));
        $this->logicNotify->handle($alipay->verify());
        return $alipay->success()->send();

    }

    /**
     * WxPay Notify
     * @return mixed
     * @throws \Yansongda\Pay\Exceptions\InvalidSignException
     */
    public function wxNotify()
    {
        $wxpay = Pay::wechat(config('wx.wechat'));
        $this->logicNotify->handle($wxpay->verify());
        return $wxpay->success()->send();
    }
}