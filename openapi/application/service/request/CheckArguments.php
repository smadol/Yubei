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

/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\service\request;
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
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @var array
     */
    private $commonArgus = [
        // 授权API KEY
        'authentication',
        // 数据签名
        'signature',
        // 32位随机字符串
        'noncestr',
        // 请求时间戳
        'timestamp',
        // 请求网关
        'resturl'
    ];


    /**
     * 校验公共头参数
     *
     * check Gateway's common arguments
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param Request $request
     * @return mixed|void
     * @throws ParameterException
     */
    public function doCheck(Request $request)
    {
        // 创建上下文
        static::createContext();
        static::set('authentication',$request->header('authentication'));
        static::set('payload',$request->param());

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
