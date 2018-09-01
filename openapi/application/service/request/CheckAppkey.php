<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\service\request;
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

        if (in_array(static::get('authentication'),$appKeyMap)) {
            return;
        }
        throw new ParameterException([
            'code'=> 404,
            'msg'=>'Appid Key is not found'
        ]);
    }
}
