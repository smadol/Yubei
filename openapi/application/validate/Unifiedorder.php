<?php
/**
 * +---------------------------------------------------------------------+
 * | Yubei      | [ WE CAN DO IT JUST THINK ]
 * +---------------------------------------------------------------------+
 * | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )
 * +---------------------------------------------------------------------+
 * | Author     | Brian Waring <BrianWaring98@gmail.com>
 * +---------------------------------------------------------------------+
 * | Company    | 小红帽科技      <Iredcap. Inc.>
 * +---------------------------------------------------------------------+
 * | Repository | https://github.com/BrianWaring/Yubei
 * +---------------------------------------------------------------------+
 */

namespace app\validate;

class Unifiedorder extends BaseValidate
{
    /**
     * 数据规则
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @var array
     */
    protected $rule = [
        'mchid'         => 'require|isNotEmpty',
        'subject'       => 'require|isNotEmpty',
        'amount'        => 'require|isNotEmpty',
        'body'          => 'require|isNotEmpty',
        'currency'      => 'require|isNotEmpty',
        'channel'       => 'require|isNotEmpty',
        'out_trade_no'  => 'require|isNotEmpty',
        'return_url'    => 'require|isNotEmpty',
        'notify_url'    => 'require|isNotEmpty'
    ];
}