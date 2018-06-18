<?php
/**
 * Created by 小羊.
 * Author: 勇敢的小笨羊
 * 微博: http://weibo.com/xuzuxing
 * Date: 2018/3/18
 * Time: 15:12
 */

namespace app\controller;

use app\service\YuPayNotify;
use Yansongda\Pay\Pay;

class Notify extends Base
{
    /**
     * Qpay Notify
     * @throws \Yansongda\Pay\Exceptions\InvalidSignException
     */
    public function qqNotify()
    {
        $notify = new YuPayNotify();
        $qpay = Pay::qpay(config('qq.qpay'));
        $notify->handle($qpay->verify());
        return $qpay->success()->send();
    }

    /**
     * AliPay Redirect
     * @throws \Yansongda\Pay\Exceptions\InvalidSignException
     * @throws \think\exception\DbException
     */
    public function aliRedirect()
    {
        $notify = new YuPayNotify();
        $this->redirect($notify->backBusiness());
    }

    /**
     * AliPay Notify
     * @return string
     * @throws \Yansongda\Pay\Exceptions\InvalidSignException
     */
    public function aliNotify()
    {
        $notify = new YuPayNotify();
        $alipay = Pay::alipay(config('ali.alipay'));
        $notify->handle($alipay->verify());
        return $alipay->success()->send();

    }

    /**
     * WxPay Notify
     * @return mixed
     * @throws \Yansongda\Pay\Exceptions\InvalidSignException
     */
    public function wxNotify()
    {
        $notify = new YuPayNotify();
        $wxpay = Pay::wechat(config('wx.wechat'));
        $notify->handle($wxpay->verify());
        return $wxpay->success()->send();
    }
}