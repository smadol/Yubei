<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\service\request;
use app\library\exception\ForbiddenException;
use app\library\exception\ParameterException;
use think\cache\driver\Redis;
use think\Request;

/**
 * 检验接口访问频率
 */
class CheckFrequent extends ApiCheck
{
    /**
     * 限定时间段
     *
     * 单位：seconds
     *
     * @var integer
     */
    private $timeScope = 60;

    /**
     * 限定次数
     *
     * @var integer
     */
    private $times = 3000;

    /**
     * @author 勇敢的小笨羊
     * @param Request $request
     * @throws ForbiddenException
     * @throws ParameterException
     */
    public function doCheck(Request $request)
    {
        // 过期验证
        if ((float)time() - (float)$request->header('timestamp') >= 2*60*1000) {
            throw new ForbiddenException(['code'=>401, 'msg'=>'Expired request']);
        }
        $key = 'Gateways-client-ip:' . $request->ip();
        $redis = new Redis();
        $value = $redis->get($key);
        echo $value;
        if (!$value) {
            $redis->set($key, $this->timeScope, 1);
        }
        if ($value >= $this->times) {
            throw new ParameterException([
                'msg'=>"too many request per {$this->timeScope} seconds",
                'code'=>1000]);
        }
        $redis->inc($key);
    }
}
