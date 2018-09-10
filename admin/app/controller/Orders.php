<?php
/**
 *  +---------------------------------------------------------------------+
 *  | Yubei      | [ WE CAN DO IT JUST THINK ]
 *  +---------------------------------------------------------------------+
 *  | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )
 *  +---------------------------------------------------------------------+
 *  | Author     | Brian Waring <BrianWaring98@gmail.com>
 *  +---------------------------------------------------------------------+
 *  | Company    | 小红帽科技      <Iredcap. Inc.>
 *  +---------------------------------------------------------------------+
 *  | Repository | https://github.com/BrianWaring/Yubei
 *  +---------------------------------------------------------------------+
 */

namespace app\controller;

class Orders extends Base
{

    /**
     * 订单列表
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     */
    public function index(){
        $where = [];
        //组合搜索
        !empty($this->request->param('keywords')) && $where['trade_no|out_trade_no|uid|id']
            = ['like', '%'.$this->request->param('keywords').'%'];

        !empty($this->request->param('channel')) && $where['channel']
            = ['eq', $this->request->param('channel')];

        !empty($this->request->param('status')) && $where['status']
            = ['eq', $this->request->param('status')];

        $this->assign('list', $this->logicOrders->getOrderList($where));

        return $this->fetch();
    }

    /**
     * 退款列表
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     */
    public function refund(){
        $where = [];
        //组合搜索
        !empty($this->request->param('keywords')) && $where['trade_no|out_trade_no|uid|id']
            = ['like', '%'.$this->request->param('keywords').'%'];

        !empty($this->request->param('channel')) && $where['channel']
            = ['eq', $this->request->param('channel')];

        !empty($this->request->param('status')) && $where['status']
            = ['eq', $this->request->param('status')];

        $this->assign('list', $this->logicOrders->getOrderList($where));

        return $this->fetch();
    }

}
