<?php
/**
 *  +---------------------------------------------------------------------+
 *  | Yubei      | [ WE CAN DO IT JUST THINK ]
 *  +---------------------------------------------------------------------+
 *  | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )
 *  +---------------------------------------------------------------------+
 *  | Author     | Brian Waring <BrianWaring98@gmail.com>
 *  +---------------------------------------------------------------------+
 *  | Company    | 小红帽科技      <Iredcap. Inc.>
 *  +---------------------------------------------------------------------+
 *  | Repository | https://github.com/BrianWaring/Yubei
 *  +---------------------------------------------------------------------+
 */

namespace app\behavior;

/**
 * 应用初始化基础信息行为
 *
 * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
 *
 */
class InitApp
{

    /**
     * 初始化行为入口
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     */
    public function run()
    {
        // 初始化分层名称常量
        $this->initLayerConst();

    }

    /**
     * 初始化分层名称常量
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     */
    private function initLayerConst()
    {

        define('LOGIC_LAYER_NAME'       , 'logic');
        define('MODEL_LAYER_NAME'       , 'model');
        define('SERVICE_LAYER_NAME'     , 'service');
        define('CONTROLLER_LAYER_NAME'  , 'controller');
        define('VALIDATE_LAYER_NAME'    , 'validate');
        define('VIEW_LAYER_NAME'        , 'view');
    }

}
