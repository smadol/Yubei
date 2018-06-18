<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */
namespace app\index\controller;


class Support extends Index
{
    /**
     * 引导
     * @return mixed
     */
    public function index()
    {
        return $this->fetch('',['title'=>'开发中心','theme'=>'theme-invert']);
    }

    /**
     * 支付开发文档
     * @return mixed
     */
    public function overview()
    {
        //$tag = $this->request->param('name','index');
        //return $this->fetch( 'overview_'.$tag,['title'=>'支付开发文档']);
        return $this->fetch( '',['title'=>'支付开发文档']);
    }

    /**
     * 帮助中心
     * @return mixed
     */
    public function help(){
        return $this->fetch();
    }

    /**
     * SDK下载
     * @return mixed
     */
    public function sdk(){
        return $this->fetch('',['title'=>'SDK下载','theme'=>'theme-invert']);
    }

}