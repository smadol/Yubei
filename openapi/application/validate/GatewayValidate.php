<?php
/**
 * Created by 小羊.
 * Author: 勇敢的小笨羊
 * 微博: http://weibo.com/xuzuxing
 * Date: 2018/3/18
 * Time: 14:54
 */
namespace app\validate;

class GatewayValidate extends BaseValidate
{
    protected $rule = [
        'mchid'         => 'require|isNotEmpty',
        'subject'       => 'require|isNotEmpty',
        'amount'        => 'require|isNotEmpty',
        'channel'       => 'require|isNotEmpty',
        'out_trade_no'  => 'require|isNotEmpty',
        'return_url'    => 'require|isNotEmpty',
        'notify_url'    => 'require|isNotEmpty'
    ];
}