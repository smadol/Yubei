<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\logic\gateway;

use app\library\exception\ParameterException;
use app\model\Api;
use think\Request;

/**
 * 检验app授权key
 */
class CheckAppkey extends ApiCheck
{
    /**
     * 校验app key
     * @author 勇敢的小笨羊
     *
     * @param Request $request
     * @throws ParameterException
     */
    public function doCheck(Request $request)
    {
        // 获取app key Map
        $appKeyMap = (array)Api::appKeyMap();

        // app key
        $appKey    = $request->header('authentication');

        if (in_array($appKey,$appKeyMap)) {
            return;
        }
        throw new ParameterException([
            'code'=> 404,
            'msg'=>'app_key is not found'
        ]);
    }
}
