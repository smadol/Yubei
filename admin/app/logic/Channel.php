<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\logic;


class Channel extends BaseLogic
{

    public function getChannelAll($where = [], $field = 'id,name,remark,rate,daily,status,update_time', $order = '', $paginate = 20){
        return $this->modelChannel->getList($where,$field, $order, $paginate);
    }

    public function getChannelParam($id){
        return $this->modelChannel->getValue(['id'=>$id],'param');
    }
}