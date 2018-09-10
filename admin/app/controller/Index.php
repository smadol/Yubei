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

namespace app\controller;

class Index extends Base
{
    /**
     * 访问首页  -  加载框架
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 欢迎主页  -  展示数据
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     */
    public function welcome()
    {
        return $this->fetch();
    }
}
