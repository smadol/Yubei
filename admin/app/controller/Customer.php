<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\controller;


use app\service\CustomerService;

class Customer extends Base
{
    /**
     * @var CustomerService
     */
    protected $service;

    /**
     * Customer constructor.
     * @param CustomerService $service
     */
    public function __construct(CustomerService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * @author 勇敢的小笨羊
     * @return mixed
     */
    public function index()
    {
        $this->assign(['list'	=>	$this->service->page()]);
        return $this->fetch();
    }

    public function create()
    {
        return $this->fetch();
    }


    public function save()
    {
        return $this->service->save();
    }

    public function edit($id)
    {
        $this->assign(['info' => $this->service->info($id)]);
        return $this->fetch();
    }

    public function update(){
        return $this->service->update();
    }

    public function delete($id){
        return $this->service->delete($id);
    }
}