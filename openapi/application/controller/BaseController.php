<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\controller;


use think\Controller;

class BaseController extends Controller
{
    /**
     * 重写获取器 兼容 模型|逻辑|验证|服务 层实例获取
     * 获取逻辑层实例  --魔术方法
     * $this->loginArticle->getArticleList()
     * 相应到logic/Article.php
     *
     * @author 勇敢的小笨羊
     * @param $logicName
     * @return \think\Model
     * @throws \Exception
     */
    public function __get($logicName)
    {
        $layer = $this->getLayerPre($logicName);

        $model = sr($logicName, $layer);

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