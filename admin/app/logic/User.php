<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */
namespace app\logic;



use think\Db;

class User extends BaseLogic
{
    /**
     * 获取商户列表
     */
    public function getUserList($where = [], $field = '*', $order = '', $paginate = 20)
    {
        return $this->modelUser->getList($where, $field, $order, $paginate);
    }

    //获取一个商户详情
    public function getUserDetail($where){
        return [
            'bank'  => $this->getBanker(),
            'user'  => $this->getUserInfo($where),
            'account'  => $this->getUserAccount($where),
            'api'  => $this->getUserApi($where),
        ];
    }

    /**
     * 获取所有支持银行
     * @author 勇敢的小笨羊
     * @return mixed
     */
    public function getBanker(){
        return $this->modelBank->getList();
    }

    /**
     * 获取商户信息
     */
    public function getUserInfo($where = [], $field = true)
    {

        return $this->modelUser->getInfo($where, $field);
    }

    /**
     * 获取商户结算账户
     * @author 勇敢的小笨羊
     * @param array $where
     * @param bool $field
     * @return mixed
     */
    public function getUserAccount($where = [], $field = true){
        return $this->modelUserAccount->getInfo($where, $field);
    }

    /**
     *
     * 获取商户支持API
     *
     * @author 勇敢的小笨羊
     * @param array $where
     * @param bool $field
     * @return mixed
     */
    public function getUserApi($where = [], $field = true){
        return $this->modelApi->getInfo($where, $field);
    }

    /**
     * 添加一个商户
     * @author 勇敢的小笨羊
     * @param $data
     * @return array|string
     */
    public function addUser($data){
        //TODO 数据验证
        $validate = $this->validateUser->scene('add')->check($data);

        if (!$validate) {
            return $this->validateUser->getError();
        }
        //TODO 添加数据
        Db::startTrans();
        try{
            $user = $this->modelUser->setInfo($data);
            $this->modelUserAccount->setInfo(['uid'  => $user ]);
            $this->modelBalance->setInfo(['uid'  => $user ]);
            $this->modelApi->setInfo([
                'uid'  => $user,
                'domain' =>  $data['siteurl'],
                'sitename' =>  $data['sitename']
            ]);
            Db::commit();
            return '添加商户成功';
        }catch (\Exception $ex){
            Db::rollback();
            return $ex->getMessage();
        }

    }

    public function editUser($data,$validate_result = true){

        //TODO  验证数据
        $data['scene'] == 'user' && $validate_result = $this->validateUser->scene('edit')->check($data);

        if (!$validate_result) {

            return $this->validateUser->getError();
        }
        //TODO 修改数据
        Db::startTrans();
        try{
            switch ($data['scene']){
                case 'user':
                    unset($data['scene']);
                    $this->modelUser->setInfo($data);
                    break;
                case 'account':
                    unset($data['scene']);
                    $this->modelUserAccount->setInfo($data);
                    break;
                case 'api':
                    unset($data['scene']);
                    //加密KEY
                    $data['key']    = data_md5_key($data['secretkey']);
                    $this->modelApi->setInfo($data);
                    break;
            }
            Db::commit();
            return '编辑成功';
        }catch (\Exception $ex){
            Db::rollback();
            return $ex->getMessage();
        }
    }

    /**
     * 删除商户
     * @author 勇敢的小笨羊
     * @param array $where
     * @return string
     */
    public function delUser($where = []){
        Db::startTrans();
        try{
            $this->modelUser->deleteInfo($where);
            $this->modelUserAccount->deleteInfo($where);
            $this->modelBalance->deleteInfo($where);
            $this->modelApi->deleteInfo($where);
            Db::commit();
            return '会员删除成功';
        }catch (\Exception $ex){
            Db::rollback();
            return $ex->getMessage();
        }
    }
    /**
     * 设置商户信息
     */
    public function setUserValue($where = [], $field = '', $value = '')
    {
        return $this->modelUser->setFieldValue($where, $field, $value);
    }
}