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
use app\library\exception\ParameterException;
use app\model\Api;
use think\Request;

/**
 * 检验app授权key
 *
 * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
 *
 */
class CheckAppkey extends ApiCheck
{
    /**
     * 校验app key
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param Request $request
     * @return mixed|void
     * @throws ParameterException
     */
    public function doCheck(Request $request)
    {
        // 获取app key Map
        $appKeyMap = (array)Api::appKeyMap();

        if (in_array(static::get('authentication'),$appKeyMap)) {
            return;
        }
        throw new ParameterException([
            'code'=> 404,
            'msg'=>'Appid Key is not found'
        ]);
    }
}
