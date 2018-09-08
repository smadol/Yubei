<?php
namespace app\model;

class User extends BaseModel
{
    /**
     * 密码修改器
     */
    public function setPasswordAttr($value)
    {
        return data_md5_key($value);
    }
}

