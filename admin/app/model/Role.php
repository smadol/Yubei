<?php
namespace app\model;

class Role extends BaseModel
{
	protected $pk = 'id';

    /**
     * 指定管理员表名
     * @var string
     */
    protected $table = 'yb_admin_role';
}

