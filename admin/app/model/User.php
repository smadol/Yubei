<?php
namespace app\model;

class User extends BaseModel
{
    /**
     * 主键
     * @var string
     */
	protected $pk = 'id';
    /**
     * 指定管理员表名
     * @var string
     */
	protected $table = 'yb_admin';

    /**
     * 查找权限
     * @author 勇敢的小笨羊
     * @return \think\model\relation\HasOne
     */
    public function findRole()
    {
        return $this->hasOne('\app\model\Role','id','role');
    }


}

