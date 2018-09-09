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

namespace app\logic;



use think\Db;
use think\Log;

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
            return [1,'添加商户成功'];
        }catch (\Exception $ex){
            Db::rollback();
            return $ex->getMessage();
        }

    }

    /**
     * 编辑商户
     * @author 勇敢的小笨羊
     * @param $data
     * @param bool $validate_result
     * @return array|string
     */
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
            return [1,'编辑成功'];
        }catch (\Exception $ex){
            Db::rollback();
            Log::error($ex->getMessage());
            return [0,'未知错误'];
        }
    }

    /**
     * 删除商户
     * @author 勇敢的小笨羊
     * @param array $where
     * @return array
     */
    public function delUser($where = []){
        Db::startTrans();
        try{
            $this->modelUser->deleteInfo($where);
            $this->modelUserAccount->deleteInfo($where);
            $this->modelBalance->deleteInfo($where);
            $this->modelApi->deleteInfo($where);
            Db::commit();
            return [1,'会员删除成功'];
        }catch (\Exception $ex){
            Db::rollback();
            Log::error($ex->getMessage());
            return [0,'未知错误'];
        }
    }


    /**
     * 改变商户可用性
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $where
     * @param int $value
     * @return array
     */
    public function setUserStatus($where,$value = 0){
        Db::startTrans();
        try{
            $this->modelUser->setFieldValue($where, $field = 'status', $value);
            Db::commit();
            return [1,'修改状态成功'];
        }catch (\Exception $ex){
            Db::rollback();
            Log::error($ex->getMessage());
            return [0,'未知错误'];
        }
    }
}