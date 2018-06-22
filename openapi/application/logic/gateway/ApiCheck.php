<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\logic\gateway;

use think\Request;

/**
 * 网关检验抽象类
 *
 * @author 勇敢的小笨羊
 * @package app\logic\gateway
 */
abstract class ApiCheck
{
    /**
     * 下一个check实体
     *
     * @var object
     */
    private $nextCheckInstance;

    /**
     * 校验方法
     *
     * @param Request $request 请求对象
     */
    abstract public function doCheck(Request $request);

    /**
     * 设置责任链上的下一个对象
     * @author 勇敢的小笨羊
     *
     * @param ApiCheck $check
     * @return ApiCheck
     */
    public function setNext(ApiCheck $check)
    {
        $this->nextCheckInstance = $check;
        return $check;
    }

    /**
     * 启动
     *
     * @author 勇敢的小笨羊
     * @param Request $request 请求对象
     */
    public function start(Request $request)
    {
        $this->doCheck($request);
        // 调用下一个对象
        if (! empty($this->nextCheckInstance)) {
            $this->nextCheckInstance->start($request);
        }
    }
}
