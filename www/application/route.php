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
//前台
//Route::get('about','index/Index/about');
//Route::get('contact','index/Index/contact');
//Route::get('terms','index/Index/terms');
//Route::get('pricing','index/Index/price');
//Route::get('webPay','index/Index/webPay');
//Route::get('webPay','index/Index/webPay');
//Route::get('wapPay','index/Index/wapPay');
//Route::get('scanPay','index/Index/scanPay');

//帮助系统
//Route::group('support',function (){
//    Route::get('/index','index/Support/index');
//    Route::get('/overview','index/Support/overview');
//    Route::get('/downloads','index/Support/sdk');
//    Route::get('/help','index/Support/help');
//});

Route::rule('login','app/Login/index','GET|POST'); //登录
Route::get('logout','app/Login/quit');//退出
Route::get('order_list','app/Order/index');//交易记录
Route::get('settle_list','app/Settle/index'); //结算记录
Route::get('asset_change','app/Asset/index');//变动记录
Route::get('cash_account','app/Asset/account'); //取现账户
Route::get('cash_list','app/Asset/cash'); //取现记录
Route::get('cash_apply','app/Asset/apply'); //申请取现
Route::get('user_index','app/User/index');
Route::rule('user_security','app/User/security','GET|POST');

