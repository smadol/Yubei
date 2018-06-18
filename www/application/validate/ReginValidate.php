<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\validate;

class ReginValidate extends BaseValidate
{
    protected $rule = [
        'username'    => 'require|email|token',
        'nickname'     => 'require',
    ];

    protected $message = [
        'username'     => '请检查邮箱',
        'nickname'     => '商户名称',
    ];

}