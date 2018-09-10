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
namespace app\controller;


use app\model\Balance;

class Test
{
    /**
     * Test
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @throws \think\Exception
     */
    public function test(){
        $model = new Balance();
        //支付成功  写入待结算金额
        $model->where(['uid'=> '100001'])->setInc('available','100' );
        //支付成功  扣除待支付金额
        $model->where(['uid'=> '100001'])->setDec('disable', '100');
    }
}