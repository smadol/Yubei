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

class Menu extends BaseLogic
{

    /**
     * 依据用户获取菜单
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $user
     * @return array
     */
    public function getMenuShow($user){
        if( $user == '1' ){
            $_menuList = $this->getMenuAll();
        }else{
            //TODO  权限处理 -- 等待处理
            $_menuList = $this->getMenu($user->findRole->ids);
        }

        return [
            '_user'   =>  $user ,
            '_menuList' =>  $_menuList
        ];
    }

    /**
     * 获取父级菜单
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     */
    public function getFather(){
        return $this->modelAdminMenu->getColumn([
            'status'	=>	1,
            'level'		=>	0
        ]);
    }

    /**
     * 获取子菜单
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     */
    public function getChild(){
        return $this->modelAdminMenu->getColumn([
            'status'	=>	1,
            'level'		=>	['>',0]
        ]);
    }

    /**
     * 获取展示菜单
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $ids
     * @return array
     */
    public function getMenu($ids){
        return [
            'father'    =>  $this->modelAdminMenu->getColumn([
                'status'    =>  0,
                'level'     =>  0,
                'id'        =>  ['in',"$ids"]
            ]),
            'child'     =>  $this->modelAdminMenu->getColumn([
                'status'    =>  0,
                'level'     =>  ['>',0],
                'id'        =>  ['in',"$ids"]
            ])
        ];
    }

    /**
     * 获取所有菜单
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return array
     */
    public function getMenuAll(){
        return [
            'father'    =>  $this->modelAdminMenu->getColumn([
                'status'    =>  1,
                'level'     =>  0
            ]),
            'child'     =>  $this->modelAdminMenu->getColumn([
                'status'    =>  1,
                'level'     =>  ['>',0]
            ])
        ];
    }

    /**
     * 获取所有菜单
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     */
    public function getAll(){
        return $this->modelAdminMenu->getList([], $field = true, $order = '', $paginate = 50);
    }

    /**
     * 获取菜单信息
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $id
     * @return mixed
     */
    public function getMenuInfo($id){
        return $this->modelAdminMenu->getInfo([
            'id'    =>  $id
        ]);
    }

    /**
     * 编辑菜单
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $data
     * @return array|string
     */
    public function editMenu($data){
        //TODO 修改数据
        Db::startTrans();
        try{
            $data['level'] = $data['pid'] == 0 ? '0' : '1';
            $this->modelAdminMenu->setInfo($data);
            Db::commit();
            return [1,'编辑成功'];
        }catch (\Exception $ex){
            Db::rollback();
            Log::error($ex->getMessage());
            return [0,'未知错误'];
        }
    }

    /**
     * 删除菜单
     * @author 勇敢的小笨羊
     * @param array $where
     * @return array
     */
    public function delMenu($where = []){
        Db::startTrans();
        try{
            $this->modelAdminMenu->deleteInfo($where);
            Db::commit();
            return [1,'菜单删除成功'];
        }catch (\Exception $ex){
            Db::rollback();
            Log::error($ex->getMessage());
            return [0,'未知错误'];
        }
    }


    /**
     * 改变菜单可用性
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $where
     * @param int $value
     * @return array
     */
    public function setMenuStatus($where,$value = 0){
        Db::startTrans();
        try{
            $this->modelAdminMenu->setFieldValue($where, $field = 'status', $value);
            Db::commit();
            return [1,'修改状态成功'];
        }catch (\Exception $ex){
            Db::rollback();
            Log::error($ex->getMessage());
            return [0,'未知错误'];
        }
    }

}