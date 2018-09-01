<?php
/**
 * Author: Single Dog
 * Github: https://github.com/SingleSheep
 * Date: 2018/2/6 - 20:04
 */

namespace app\model;

use think\Model;

class BaseModel extends Model
{

    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

    /**
     * 重写获取器 兼容 模型|逻辑|验证|服务 层实例获取
     */
    public function __get($name)
    {

        $layer = $this->getLayerPre($name);

        if (false === $layer) {

            return parent::__get($name);
        }

        $model = sr($name, $layer);

        return VALIDATE_LAYER_NAME == $layer ? validate($model) : model($model, $layer);
    }

    /**
     * 获取层前缀
     */
    public function getLayerPre($name)
    {

        $layer = false;

        $layer_array = [MODEL_LAYER_NAME, LOGIC_LAYER_NAME, VALIDATE_LAYER_NAME, SERVICE_LAYER_NAME];

        foreach ($layer_array as $v)
        {
            if (str_prefix($name, $v)) {

                $layer = $v;

                break;
            }
        }

        return $layer;
    }
}