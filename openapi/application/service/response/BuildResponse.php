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

namespace app\service\response;
use think\exception\HttpResponseException;
use think\Log;
use think\Response;

class BuildResponse extends ApiSend
{


    /**
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param array $chargeRespose
     * @throws \app\library\exception\ParameterException
     */
    public function doBuild($chargeRespose)
    {
        http_response_code(200);    //设置返回头部
        $return['result_code'] = 'OK';
        $return['result_msg'] = 'SUCCESS';
        $return['charge'] =  static::get('ApiResposeData');

        Log::notice('Response Data:'.json_encode($return));

        //签名及数据返回
        $response = Response::create(json_encode($return))->header(static::get('header'));
        // 销毁请求上下文
        static::destoryContext();
        Log::notice("结束时间：".microtime());
        // 抛数据
        throw new HttpResponseException($response);
    }


}