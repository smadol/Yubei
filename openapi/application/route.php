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
Route::rule('pay/gateway','Gateway/gateway');//网关支付
Route::post('pay/unifiedorder','Gateway/unifiedorder','POST');//网关支付
Route::post('pay/orderquery','Gateway/orderquery','POST');//网关支付

Route::get('que/hello','Que/actionWithHelloJob');