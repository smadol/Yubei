<?php
/**
 * Created by 小羊.
 * Author: 勇敢的小笨羊
 * 微博: http://weibo.com/xuzuxing
 * Date: 2018/3/21
 * Time: 23:17
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
     * @throws MissException
     */
    public function index()
    {
        throw new MissException();
    }
}