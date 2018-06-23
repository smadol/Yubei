<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\logic\response;

use think\exception\HttpResponseException;
use think\Log;
use think\Response;

class BuildResponse extends ApiSend
{


    /**
     * @author 勇敢的小笨羊
     * @param array $chargeRespose 第三方返回的支付信息包
     * @throws \app\library\exception\ParameterException
     */
    public function doBuild($chargeRespose)
    {
        http_response_code(200);    //设置返回头部
        $return['result_code'] = 'OK';
        $return['result_msg'] = 'SUCCESS';
        $return['charge'] =  static::get('ApiResposeData');

        Log::record('Response Data:'.json_encode($return));

        //签名及数据返回
        $response = Response::create(json_encode($return))->header(static::get('header'));
        // 销毁请求上下文
        static::destoryContext();
        Log::record(microtime());
        // 抛数据
        throw new HttpResponseException($response);
    }


}