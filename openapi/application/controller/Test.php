<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\controller;


use app\model\Balance;

class Test
{
    public function test(){
        $model = new Balance();
        //支付成功  写入待结算金额
        $model->where(['uid'=> '100001'])->setInc('available','100' );
        //支付成功  扣除待支付金额
        $model->where(['uid'=> '100001'])->setDec('disable', '100');
    }
}