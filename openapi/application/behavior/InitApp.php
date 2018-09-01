<?php
/**
 *  +---------------------------------------------------------------------+
 *  | Yubei    | [ WE CAN DO IT JUST THINK ]                              |
 *  +---------------------------------------------------------------------+
 *  | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )           |
 *  +---------------------------------------------------------------------+
 *  | Author     | Brian Waring <BrianWaring98@gmail.com>                 |
 *  +---------------------------------------------------------------------+
 *  | Repository | https://github.com/BrianWaring/Yubei                   |
 *  +---------------------------------------------------------------------+
 *
 */

namespace app\behavior;


/**
 * 应用初始化基础信息行为
 */
class InitApp
{

    /**
     * 初始化行为入口
     */
    public function run()
    {

        // 初始化分层名称常量
        $this->initLayerConst();

        // 初始化结果常量
        $this->initResultConst();

        // 初始化时间常量
        $this->initTimeConst();

        // 初始化数据状态常量
        $this->initDataStatusConst();

        // 初始化API常量
        $this->initApiConst();
    }

    /**
     * 初始化分层名称常量
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

    /**
     * 初始化结果标识常量
     */
    private function initResultConst()
    {

        define('RESULT_SUCCESS'         , 'success');
        define('RESULT_ERROR'           , 'error');
        define('RESULT_REDIRECT'        , 'redirect');
        define('RESULT_MESSAGE'         , 'message');
        define('RESULT_URL'             , 'url');
        define('RESULT_DATA'            , 'data');
    }

    /**
     * 初始化数据状态常量
     */
    private function initDataStatusConst()
    {

        define('DATA_STATUS_NAME'       , 'status');
        define('DATA_NORMAL'            , 1);
        define('DATA_DISABLE'           , 0);
        define('DATA_DELETE'            , -1);
        define('DATA_SUCCESS'           , 1);
        define('DATA_ERROR'             , 0);
    }

    /**
     * 初始化API常量
     */
    private function initApiConst()
    {

        define('API_VER_CODE'           , 'v1.0.0.20180808_beta');
        define('API_CODE_NAME'          , 'return_code');
        define('API_MSG_NAME'           , 'return_msg');
    }

    /**
     * 初始化时间常量
     */
    private function initTimeConst()
    {

        define('TIME_CT_NAME'           , 'create_time');
        define('TIME_UT_NAME'           , 'update_time');
        define('TIME_NOW'               , time());
    }

}
