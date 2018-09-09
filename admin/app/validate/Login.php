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

namespace app\validate;

/**
 * 登录验证器
 *
 * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
 *
 */
class Login extends BaseValidate
{

    /**
     * 验证规则
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @var array
     */
    protected $rule =   [

        'username'  => 'require',
        'password'  => 'require',
        'verify'    => 'require|captcha',
    ];

    /**
     * 验证消息
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @var array
     */
    protected $message  =   [

        'username.require'    => '用户名不能为空',
        'password.require'    => '密码不能为空',
        'verify.require'      => '验证码不能为空',
        'verify.captcha'      => '验证码不正确',
    ];
}
