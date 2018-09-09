<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use think\Response;
use think\exception\HttpResponseException;

/**
 * 检测用户是否登录
 * @return integer 0-未登录，大于0-当前登录用户ID
 */
function is_login()
{
    $user = session('admin_auth');
    if (empty($user)) {

        return false;
    } else {

        return session('admin_auth_sign') == data_auth_sign($user) ? $user['id'] : false;
    }
}

/**
 * 清除登录 session
 *
 * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
 *
 */
function clear_login_session()
{
    session('admin_info',      null);
    session('admin_auth',      null);
    session('admin_auth_sign', null);
}
/**
 * 数据签名认证
 * @param  array  $data 被认证的数据
 * @return string       签名
 */
function data_auth_sign($data)
{

    // 数据类型检测
    if (!is_array($data)) {

        $data = (array)$data;
    }

    // 排序
    ksort($data);

    // url编码并生成query字符串
    $code = http_build_query($data);

    // 生成签名
    $sign = sha1($code);

    return $sign;
}

/**
 * 使用上面的函数与系统加密KEY完成字符串加密
 * @param  string $str 要加密的字符串
 * @return string
 */
function data_md5_key($str, $key = '')
{

    if (is_array($str)) {

        ksort($str);

        $data = http_build_query($str);

    } else {

        $data = (string) $str;
    }

    return empty($key) ? data_md5($data,config('secret.data_salt')) : data_md5($data, $key);
}

/**
 * 系统非常规MD5加密方法
 * @param  string $str 要加密的字符串
 * @return string
 */
function data_md5($str, $key = 'Yubei')
{

    return '' === $str ? '' : md5(sha1($str) . $key);
}


/**
 * 数组转换为字符串，主要用于把分隔符调整到第二个参数
 * @param  array  $arr  要连接的数组
 * @param  string $glue 分割符
 * @return string
 */
function arr2str($arr, $glue = ',')
{

    return implode($glue, $arr);
}

/**
 * 字符串转换为数组，主要用于把分隔符调整到第二个参数
 * @param  string $str  要分割的字符串
 * @param  string $glue 分割符
 * @return array
 */
function str2arr($str, $glue = ',')
{

    return explode($glue, $str);
}

/**
 * 字符串替换
 * @param string $str
 * @param string $target
 * @param string $content
 *
 * @return mixed
 */
function sr($str = '', $target = '', $content = '')
{

    return str_replace($target, $content, $str);
}

/**
 * 字符串前缀验证
 */
function str_prefix($str, $prefix)
{

    return strpos($str, $prefix) === 0 ? true : false;
}

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
function result($code = 0, $msg = '', $data ='No Data', $type = '', array $header = [])
{

    $result = is_array($code) ? parseJumpArray($code) : parseJumpArray([$code, $msg, $data]);

    $response = Response::create($result, 'json')->header($header);

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
function parseJumpArray($data = [])
{
    !isset($data[2]) && $data[2] = 'No Data';

    return ['code' => $data[0], 'msg' => $data[1] ,'data' => $data[2]];
}