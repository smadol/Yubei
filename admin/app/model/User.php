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

namespace app\model;

class User extends BaseModel
{
    /**
     * 密码修改器
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttr($value)
    {
        return data_md5_key($value);
    }
}

