<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\logic\gateway;

use app\library\exception\ParameterException;
use think\Request;


/**
 * 检验网关公共必传参数
 *
 * check Gateway's common arguments
 */
class CheckArguments extends ApiCheck
{
    /**
     * 网关参数
     *
     * common arguments
     *
     * @var
     */
    private $commonArgus = [
        // 授权API KEY
        'authentication',
        // 数据签名
        'signature',
        // 32位随机字符串
        'noncestr',
        //请求时间戳
        'timestamp'
    ];

    /**
     * 校验公共头参数
     *
     * check Gateway's common arguments
     *
     * @param Request $request 请求对象
     * @throws ParameterException
     */
    public function doCheck(Request $request)
    {
        // 获取所有参数
        $header = $request->header();
        foreach ($this->commonArgus as $v) {
            if (! isset($header[$v]) || empty($header[$v])) {
                throw new ParameterException(
                    ['msg'=>"Gateway's common argument [{$v}] is empty",
                    'code'=>400]);
            }
        }
    }
}
