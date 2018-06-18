<?php
/**
 * Author: Single Dog
 * Github: https://github.com/SingleSheep
 * Date: 2018/2/6 - 20:00
 */

namespace app\logic;

use app\model\User;
use app\model\Asset;
use app\model\PayOrder;
use app\service\YuPay;
use app\library\exception\ForbiddenException;
use app\library\exception\OrderException;
use app\library\exception\ParameterException;
use app\library\exception\UserException;
use think\Db;
use think\Exception;
use think\Log;

class PrePay
{
    protected static $order;       //商户订单信息
    protected static $payId;       //微信支付Id
    protected static $Mch;    //商户信息

    /**
     * 静态变量保存全局的实例
     * @var null
     */
    private static $_instance = null;

    /**
     * 私有的构造方法
     */
    private function __construct() {

    }

    /**
     * 静态方法 单例模式统一入口
     *
     * @param null $orderInfo
     * @return PrePay|null
     * @throws OrderException
     * @throws ParameterException
     * @throws UserException
     * @throws \think\exception\DbException
     */
    public static function getInstance($orderInfo = null) {
        if(is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        //初始化订单信息
        if(is_null($orderInfo)){
            throw new ParameterException([
                'msg'   => 'Error Of Order Parameter.'
            ]);
        }else{
            self::$order = $orderInfo;
            //单一订单号校验
            $order = PayOrder::get(['out_trade_no'=>$orderInfo['out_trade_no']]);
            if ($order){
                throw new OrderException([
                    'msg'   =>  'Repeat Order Number.'
                ]);
            }
            //mchid /appid 
            $Mch = User::get(['uid' => self::$order['mchid']]);
            if($Mch){
                if ($Mch['status'] !== 1){
                    throw new UserException(['msg'=>'Merchants Disable.']);
                }
                self::$Mch = $Mch;  //初始化商户信息
            }else{
                throw new UserException(['msg'=>'The Merchant Does Not Exist, Please Check The Merchant ID']);
            }

        }
        return self::$_instance;
    }

    /**
     * 创建支付订单
     * @return array|mixed
     * @throws OrderException
     */
    public function prepay(){
        Db::startTrans();
        try{
            $order = new PayOrder();
            $order->uid= self::$order['mchid']; //商户ID
            $order->subject= self::$order['subject'];//支付项目
            $order->body= self::$order['body'];//支付具体内容
            $order->trade_no= self::makeNo();//支付单号
            $order->out_trade_no  = self::$order['out_trade_no'];//商户单号
            $order->amount= self::$order['amount'];//支付金额
            $order->currency= self::$order['currency'];//支付货币
            $order->channel= self::$order['channel'];//支付渠道
            $order->client_ip= self::$order['client_ip'];//订单创建IP
            $order->return_url= self::$order['return_url'];//通知Url
            $order->notify_url= self::$order['notify_url'];//通知Url
            $order->extra= json_encode(self::$order['extparam']);//拓展参数
            $order->save();
            //商户订单入库完成
            //写入待支付金额
            Asset::IncDis(self::$order['mchid'],self::$order['amount']);
            $result = (new YuPay($order->trade_no))->pay();  //支付
            Db::commit();
            return $result;

        }catch (Exception $e){
            Log::record("ERROR:[{$e->getMessage()}]");
            Db::rollback();
            throw new OrderException([
                'msg'   =>  "Create Payment Order Error, Please Try Again Later."
            ]);
        }
    }

    /**
     * 生成微信支付订单号
     * @return string
     */
    public function makeNo()
    {
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $orderSn =
            $yCode[intval(date('Y')) - 2018] . date('YmdHis') . strtoupper(dechex(date('m')))
            . date('d') . sprintf('%02d', rand(0, 999));
        return $orderSn;
    }
}