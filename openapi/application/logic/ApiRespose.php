<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\logic;

use app\logic\response\BuildEncrypt;
use app\logic\response\BuildHeader;
use app\logic\response\BuildResponse;
use app\logic\response\BuildSign;
use think\Log;

/**
 * API响应
 * Class ApiRespose
 * @package app\api\logic
 */
class ApiRespose extends Yubei
{
    /**
     * 响应数据 对象链
     * @author 勇敢的小笨羊
     * @param $chargeRespose
     */
    public static function send($chargeRespose){

        // 初始化一个：签名校验的Encrypt
        $buildEncrypt     =  new BuildEncrypt();
        // 初始化一个：签名校验的Sign
        $buildSign        =  new BuildSign();
        // 初始化一个：签名校验的Header
        $buildHeader      =  new BuildHeader();
        // 初始化一个：Response
        $buildResponse    =  new BuildResponse();

        // 构成对象链
        $buildEncrypt->setNext($buildSign)
                        ->setNext($buildHeader)
                            ->setNext($buildResponse);

        // 启动Send
        $buildEncrypt->start($chargeRespose);
    }
}