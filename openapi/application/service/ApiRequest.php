<?php

/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\service;

use app\service\request\CheckAppkey;
use app\service\request\CheckArguments;
use app\service\request\CheckFrequent;
use app\service\request\CheckSign;
use think\Log;
use think\Request;
/**
 * 网关入口实体
 *
 * 初始化网关
 *
 * 责任链模式实现的网关
 */
class ApiRequest extends Rest
{
    public function appBegin(){
        Log::record(microtime());
        // 初始化一个：访问频次校验的check
        $checkFrequent    =  new CheckFrequent();
        // 初始化一个：必传参数校验的check
        $checkArguments   =  new CheckArguments();
        // 初始化一个：令牌校验的check
        $checkAppkey      =  new CheckAppkey();
        // 初始化一个：签名校验的check
        $checkSign        =  new CheckSign();

        // 构成对象链
        $checkFrequent->setNext($checkArguments)
            ->setNext($checkAppkey)
            ->setNext($checkSign);

        // 启动网关
        $checkArguments->start(Request::instance());
    }
}