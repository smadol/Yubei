<?php
/**
 * Author: Single Dog
 * Github: https://github.com/SingleSheep
 * Date: 2018/2/6 - 19:58
 */
namespace app\controller;

use app\logic\ApiRequest;
use think\Controller;

class Base extends Controller
{
    /**
     * signatureVerification
     * @throws \app\library\exception\ForbiddenException
     * @throws \app\library\exception\SignatureException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function signatureVerification(){
        ApiRequest::getInstance($this->request->header())->verify(json_encode($this->request->post()));
    }
}