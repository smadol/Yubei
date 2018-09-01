<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\service;
use app\service\response\BuildCharge;
use app\service\response\BuildEncrypt;
use app\service\response\BuildHeader;
use app\service\response\BuildResponse;
use app\service\response\BuildSign;

/**
 * API响应
 * Class ApiRespose
 * @package app\logic
 */
class ApiRespose extends Rest
{
    /**
     * 响应数据 对象链
     * @author 勇敢的小笨羊
     * @param array $chargeRespose 第三方返回的支付信息包
     */
    public static function send($chargeRespose){

        // 初始化一个：相应对象Charge
        $buildCharge      =  new BuildCharge();
        // 初始化一个：签名校验的Encrypt
        $buildEncrypt     =  new BuildEncrypt();
        // 初始化一个：签名校验的Sign
        $buildSign        =  new BuildSign();
        // 初始化一个：签名校验的Header
        $buildHeader      =  new BuildHeader();
        // 初始化一个：Response
        $buildResponse    =  new BuildResponse();

        // 构成对象链
        $buildCharge->setNext($buildEncrypt)
                    ->setNext($buildSign)
                    ->setNext($buildHeader)
                    ->setNext($buildResponse);

        // 启动Send
        $buildCharge->start($chargeRespose);
    }
}