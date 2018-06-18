<?php

namespace app\controller;


use app\service\ChannelService;

class Channel extends Base
{
    /**
     * @var ChannelService
     */
    protected $service;

    /**
     * Order constructor.
     * @param ChannelService $service
     */
    public function __construct(ChannelService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * 支付渠道
     * @author 勇敢的小笨羊
     * @return mixed
     */
    public function index()
    {
        $this->assign(['list'  =>  $this->service->page()]);
        return $this->fetch();
    }

    /**
     * 新增支付渠道
     * @author 勇敢的小笨羊
     * @return mixed
     */
    public function create()
    {
        return $this->fetch();
    }

    public function save()
    {
        return $this->service->save();
    }

    /**
     * 渠道编辑
     * @author 勇敢的小笨羊
     * @param integer $id 渠道ID
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function edit($id)
    {
        $this->assign(['info' =>$channel = $this->service->info($id)]);
        $app = json_decode($channel['param']);
        $new = [];
        foreach ($app as $k => $v){
            $new[$k] = $v;
        }
        $this->assign(['app' =>$new]);
        return $this->fetch();
    }

    public function update(){
        return $this->service->update();
    }

    public function delete($id){
        return $this->service->delete($id);
    }
}
