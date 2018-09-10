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

namespace app\service\request;
use app\library\exception\ForbiddenException;
use app\library\exception\ParameterException;
use think\cache\driver\Redis;
use think\Log;
use think\Request;

/**
 * 检验接口访问频率
 *
 * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
 *
 */
class CheckFrequent extends ApiCheck
{
    /**
     * 限定时间段
     *
     * 单位：seconds
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @var int
     */
    private $timeScope = 1;

    /**
     * 限定次数
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @var int
     */
    private $times = 10;

    /**
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param Request $request
     * @return mixed|void
     * @throws ParameterException
     */
    public function doCheck(Request $request)
    {
        $key = 'Gateways-client-ip:' . $request->ip();
        $redis = new Redis();
        $value = $redis->get($key);

        if (!$value) {
            $redis->set($key, $this->timeScope, 1);
        }
        if ($value >= $this->times) {
            Log::error($key);
            throw new ParameterException([
                'msg'=>"too many request per {$this->timeScope} seconds",
                'code'=>1000]);
        }
        $redis->inc($key);
    }
}
