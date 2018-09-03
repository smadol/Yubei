<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::miss('api/Miss/index');//路由错误返回
Route::rule('pay/gateway','Pay/gateway');//网关支付
Route::post('pay/unifiedorder','Pay/unifiedorder');//网关支付
Route::get('pay/orderquery','Pay/orderquery');//网关支付

/**
 * Notify
 */
Route::post('notify/qq','Notify/qqNotify');//QQ异步通知
Route::post('notify/wx','Notify/wxNotify');//微信异步通知
Route::post('notify/ali','Notify/aliNotify');//支付宝异步通知
Route::get('notify/ali_r','Notify/aliRedirect');//支付宝同步回调



Route::get('test','Test/test');
