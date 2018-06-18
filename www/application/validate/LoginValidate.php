<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\validate;

class LoginValidate extends BaseValidate
{
    protected $rule = [
        'username'  => 'require|email',
        'password'  => 'require',
    ];

    protected $message = [
        'username.require'=> '请检查商户邮箱是否为空',
        'username.email'  => '请检查商户邮箱是否正确',
        'password.require'=> '请检查登录密码',
    ];
}