<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\lilibraryb;

use app\model\Asset;
use app\model\PayOrder;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Exception;

class OrderExectute extends Command
{
    protected function configure()
    {
        $this->setName('OrderExectute')->setDescription('Here is the OrderExectute ');
    }

    /**
     * @param Input $input
     * @param Output $output
     * @return int|null|void
     * @throws Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function execute(Input $input, Output $output)
    {
        $res = (new PayOrder())->where(['status'=>1])->select();
        foreach($res as $k){
            echo $k['mchid'];
            (new PayOrder())->where(['status'=>1])->update(['status'=>0]);
            (new Asset())->where(['mchid' => $k['mchid']])->setDec('disable', $k['amount']);
        }
        $output->writeln("OrderExectute:");
    }

}