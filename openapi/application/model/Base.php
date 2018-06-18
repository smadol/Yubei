<?php
/**
 * Author: Single Dog
 * Github: https://github.com/SingleSheep
 * Date: 2018/2/6 - 20:04
 */

namespace app\model;


use think\Model;

class Base extends Model
{

    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

}