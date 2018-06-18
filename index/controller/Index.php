<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\index\controller;


use app\common\model\PayOrder;
use app\common\model\UserAsset;
use think\Db;

class Index extends Base
{

    /**
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {

        //资产信息
        $data = new UserAsset();
        $asset = $data->where(['mchid' => $this->userInfo['mchid']])->find();

        //
        $model = new PayOrder();
        $order = $model->where(['mchid' => $this->userInfo['mchid']])
            ->count();
        $this->assign('order_count',$order);
        $this->assign('asset',$asset);
        return $this->fetch();
    }
}