<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\controller;


use app\model\Asset;
use app\model\PayOrder;

class Index extends Base
{

    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $this->assign('chart',$this->getChartData());
        $this->assign('asset',Asset::getDetail());
        return $this->fetch();
    }

    /**
     * 获取每日订单统计
     * @return mixed
     */
    private function getChartData(){
        $model = new PayOrder();
        $where = ['uid' => $this->userInfo->uid];
        $arr[0]= time()-((date('w')==0?7:date('w'))-1)*24*3600;
        $arr[1]= time()-((date('w')==0?7:date('w'))-2)*24*3600;
        $arr[2]= time()-((date('w')==0?7:date('w'))-3)*24*3600;
        $arr[3]= time()-((date('w')==0?7:date('w'))-4)*24*3600;
        $arr[4]= time()-((date('w')==0?7:date('w'))-5)*24*3600;
        $arr[5]= time()-((date('w')==0?7:date('w'))-6)*24*3600;
        $arr[6]= time()-((date('w')==0?7:date('w'))-7)*24*3600;
        $new=array();
        foreach($arr as $k=>$v){
            $new[$k]['start']=mktime(0,0,0,date("m",$v),date("d",$v),date("Y",$v));
            $new[$k]['end']= mktime(23,59,59,date("m",$v),date("d",$v),date("Y",$v));
            foreach ($new as $key => $value){
                $newdata[$key] = $model->where($where)->whereTime('create_time','between',[ $value['start'], $value['end']])->count();
            }
        }
        return $newdata;
    }
}