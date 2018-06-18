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

/**
 * @param $url
 * @param $rawData
 * @param string $target
 * @param int $retry
 * @param int $sleep
 * @param int $second
 * @return mixed
 */
function curl_post_raw($url, $rawData, $target = 'FAIL', $retry=6, $sleep = 3 ,$second = 30)
{
    $ch = curl_init();
    //设置超时
    curl_setopt($ch, CURLOPT_TIMEOUT, $second);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $rawData);
    curl_setopt(
        $ch, CURLOPT_HTTPHEADER,
        array(
            'Content-Type: text'
        )
    );
    //运行curl
    $output = curl_exec($ch);
    while (strpos($output, $target) !== false && $retry--) {
        //检查$targe是否存在
        sleep($sleep); //阻塞3s
        $sleep += 2;
        $output = curl_exec($ch);
    }
    curl_close($ch);
    return $output;
}