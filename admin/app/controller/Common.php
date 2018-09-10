<?php
/**
 * +---------------------------------------------------------------------+
 * | Yubei    | [ WE CAN DO IT JUST THINK ]
 * +---------------------------------------------------------------------+
 * | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )
 * +---------------------------------------------------------------------+
 * | Author     | Brian Waring <BrianWaring98@gmail.com>
 * +---------------------------------------------------------------------+
 * | Repository | https://github.com/BrianWaring/Yubei
 * +---------------------------------------------------------------------+
 */

namespace app\controller;


use think\Controller;
use think\exception\HttpResponseException;
use think\Response;

class Common extends Controller
{

    /**
     * 数据返回
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param mixed $data
     * @param int $code
     * @param string $msg
     * @param string $type
     * @param array $header
     */
    final protected function result($code = 0, $msg = '', $data ='No Data', $type = 'json', array $header = [])
    {

        $result = is_array($code) ? parseJumpArray($code) : parseJumpArray([$code, $msg, $data]);

        $response = Response::create($result, $type)->header($header);

        throw new HttpResponseException($response);
    }

    /**
     * 解析数组
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param array $data
     * @return array
     */
    final protected function parseJumpArray($data = [])
    {
        !isset($data[2]) && $data[2] = 'No Data';

        return ['code' => $data[0], 'msg' => $data[1] ,'data' => $data[2]];
    }

    /**
     * 获取逻辑层实例  --魔术方法
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $name
     * @return \think\Model
     * @throws \Exception
     */
    public function __get($name)
    {

        !str_prefix($name, LOGIC_LAYER_NAME) && exception('逻辑层引用需前缀:' . LOGIC_LAYER_NAME);

        return model(sr($name, LOGIC_LAYER_NAME), LOGIC_LAYER_NAME);
    }
}