<?php
/**
 * +---------------------------------------------------------------------+
 * | Yubei    | [ WE CAN DO IT JUST THINK ]
 * +---------------------------------------------------------------------+
 * | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )
 * +---------------------------------------------------------------------+
 * | Author     | Brian Waring <BrianWaring98@gmail.com>
 * +---------------------------------------------------------------------+
 * | Repository | https://github.com/BrianWaring/Yubei
 * +---------------------------------------------------------------------+
 */

namespace app\controller;


class Channel extends Base
{
    /**
     * 支付渠道列表
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
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
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     */
    public function add()
    {
        // post 是提交数据
        $this->request->isPost() && $this->result($this->logicChannel->addChannel($this->request->post()));

        return $this->fetch();
    }

    /**
     * 编辑支付渠道
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     */
    public function edit(){
        // post 是提交数据
        $this->request->isPost() && $this->result($this->logicChannel->editChannel($this->request->post()));

        //获取渠道详细信息
        $this->assign('channel',$this->logicChannel->getChannelInfo(['id' =>$this->request->param('id')]));

        return $this->fetch();
    }

    /**
     * 删除渠道
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     */
    public function del(){
        // post 是提交数据
        $this->request->isPost() && $this->result(
            $this->logicChannel->delChannel(
                [
                    'id' => $this->request->param('id')
                ])
        );

        // get 直接报错
        $this->error('未知错误');
    }

    /**
     * 查看渠道支付配置
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param int $id 渠道ID
     */
    public function getParam($id = 0){
        $this->result($this->logicChannel->getChannelParam($id));
    }

    /**
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param int $id 渠道ID
     * @param bool $status 渠道状态
     */
    public function changeStatus($id = 0,$status = false){
        $this->result($this->logicChannel->setChannelStatus(['id'=>$id], $status == 1 ? '0': '1'));
    }
}
