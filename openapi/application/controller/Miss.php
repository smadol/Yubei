<?php
/**
 * +---------------------------------------------------------------------+
 * | Yubei      | [ WE CAN DO IT JUST THINK ]
 * +---------------------------------------------------------------------+
 * | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )
 * +---------------------------------------------------------------------+
 * | Author     | Brian Waring <BrianWaring98@gmail.com>
 * +---------------------------------------------------------------------+
 * | Company    | 小红帽科技      <Iredcap. Inc.>
 * +---------------------------------------------------------------------+
 * | Repository | https://github.com/BrianWaring/Yubei
 * +---------------------------------------------------------------------+
 */
namespace app\controller;

use app\library\exception\MissException;

use think\Controller;

/**
 * MISS路由，当全部路由没有匹配到时
 * 将返回资源未找到的信息
 */
class Miss extends Controller
{
    /**
     * MissException
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @throws MissException
     */
    public function index()
    {
        throw new MissException();
    }
}