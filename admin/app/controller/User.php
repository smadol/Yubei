<?php
namespace app\controller;

class User extends Base
{

    public function index(){

        $where = [];
        //组合搜索
        !empty($this->request->param('keywords')) && $where['uid|nickname|username|account|phone']
            = ['like', '%'.$this->request->param('keywords').'%'];

        $this->assign('list', $this->logicUser->getUserList($where));

        return $this->fetch();
    }

    public function add(){
        // post 是提交数据
        $this->request->isPost() && $this->success($this->logicUser->addUser($this->request->post()));
        return $this->fetch();
    }

    public function edit(){
        // post 是提交数据
        $this->request->isPost() && $this->success($this->logicUser->editUser($this->request->post()));
        //获取商户详细信息
        $this->assign($this->logicUser->getUserDetail(['uid' =>$this->request->param('id')]));
        return $this->fetch();
    }

    /**
     * 删除商户
     * @author 勇敢的小笨羊
     *
     */
    public function del(){
        // post 是提交数据
        $this->request->isPost() && $this->success(
            $this->logicUser->delUser(
                [
                    'uid' => $this->request->param('uid')
                ])
        );
        // get 直接报错
        $this->error();
    }
    public function cash(){
        $this->assign('list', $this->logicUser->getUserList());
        return $this->fetch();
    }
}
