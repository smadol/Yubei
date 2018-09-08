<?php

namespace app\controller;


class Channel extends Base
{
    /**
     * 支付渠道
     * @author 勇敢的小笨羊
     * @return mixed
     */
    public function index()
    {
        $where = [];
        //组合搜索
        !empty($this->request->param('keywords')) && $where['id|name']
            = ['like', '%'.$this->request->param('keywords').'%'];
        $this->assign('list',$this->logicChannel->getChannelAll($where));
        return $this->fetch();
    }

    /**
     * 新增支付渠道
     * @author 勇敢的小笨羊
     * @return mixed
     */
    public function add()
    {
        return $this->fetch();
    }

    public function getParam($id){
       return $this->logicChannel->getChannelParam($id);
    }
}
