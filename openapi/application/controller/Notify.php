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
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Yansongda\Pay\Exceptions\InvalidArgumentException
     * @throws \Yansongda\Pay\Exceptions\InvalidSignException
     */
    public function wxNotify()
    {
        $wxpay = Pay::wechat(config('wx.wechat'));
        $this->logicNotify->handle($wxpay->verify());
        return $wxpay->success()->send();
    }
}