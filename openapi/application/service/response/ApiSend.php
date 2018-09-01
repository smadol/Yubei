<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\service\response;
use app\service\ApiRespose;

/**
 * 报文通知抽象类
 *
 * @author 勇敢的小笨羊
 * @package app\logic\gateway
 */
abstract class ApiSend extends ApiRespose
{

    /**
     * 通知报文
     *
     * @var object
     */
    protected $payload;

    /**
     * 下一个check实体
     *
     * @var object
     */
    private $nextCheckInstance;

    /**
     * 构建方法
     *
     * @param array $chargeRespose 支付对象
     */
    abstract public function doBuild($chargeRespose);

    /**
     * 设置责任链上的下一个对象
     * @author 勇敢的小笨羊
     *
     * @param ApiSend $check
     * @return ApiSend
     */
    public function setNext(ApiSend $check)
    {
        $this->nextCheckInstance = $check;
        return $check;
    }

    /**
     * 启动
     *
     * @author 勇敢的小笨羊
     * @param array $chargeRespose 支付对象
     */
    public function start($chargeRespose)
    {
        $this->doBuild($chargeRespose);
        // 调用下一个对象
        if (! empty($this->nextCheckInstance)) {
            $this->nextCheckInstance->start($chargeRespose);
        }
    }
}