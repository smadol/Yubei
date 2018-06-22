<?php

/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\behavior;

use app\logic\gateway\CheckAppkey;
use app\logic\gateway\CheckArguments;
use app\logic\gateway\CheckFrequent;
use app\logic\gateway\CheckSign;
use think\Request;
/**
 * 网关入口实体
 *
 * 初始化网关
 *
 * 责任链模式实现的网关
 */
class GatewayInit
{
    public function appBegin(){
        // 初始化一个：必传参数校验的check
        $checkArguments   =  new CheckArguments();
        // 初始化一个：令牌校验的check
        $checkAppkey      =  new CheckAppkey();
        // 初始化一个：访问频次校验的check
        $checkFrequent    =  new CheckFrequent();
        // 初始化一个：签名校验的check
        $checkSign        =  new CheckSign();

        // 构成对象链
        $checkArguments->setNext($checkAppkey)
            ->setNext($checkFrequent)
            ->setNext($checkSign);

        // 启动网关
        $checkArguments->start(Request::instance());
    }
}
