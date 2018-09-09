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

class User extends Base
{

    /**
     * 商户列表
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     */
    public function index(){

        $where = [];
        //组合搜索
        !empty($this->request->param('keywords')) && $where['uid|nickname|username|account|phone']
            = ['like', '%'.$this->request->param('keywords').'%'];

        $this->assign('list', $this->logicUser->getUserList($where));

        return $this->fetch();
    }

    /**
     * 添加商户
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     */
    public function add(){
        // post 是提交数据
        $this->request->isPost() && $this->result($this->logicUser->addUser($this->request->post()));
        //获取商户详细信息
        $this->assign('bank',$this->logicUser->getBanker());

        return $this->fetch();
    }

    /**
     * 编辑商户
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     */
    public function edit(){
        // post 是提交数据
        $this->request->isPost() && $this->result($this->logicUser->editUser($this->request->post()));
        //获取商户详细信息
        $this->assign($this->logicUser->getUserDetail(['uid' =>$this->request->param('id')]));

        return $this->fetch();
    }

    /**
     * 修改商户状态
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param int $id
     * @param bool $status
     */
    public function changeStatus($id = 0,$status = false)
    {

        $this->result($this->logicUser->setUserStatus(['uid'=>$id], $status == 1 ? '0': '1'));
    }

    /**
     * 删除商户
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     */
    public function del(){
        // post 是提交数据
        $this->request->isPost() && $this->result(
            $this->logicUser->delUser(
                [
                    'uid' => $this->request->param('id')
                ])
        );
        // get 直接报错
        $this->error([0,'未知错误']);
    }

    /**
     * 结算管理
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     */
    public function cash(){
        $this->assign('list', $this->logicUser->getUserList());
        return $this->fetch();
    }
}
