<?php


//接收传送的数据
$data = file_get_contents("php://input");

Log::Init();
try {

    $result = json_decode($data);
    //处理之后设置ReturnCode 默认返回处理成功，异常处理可以返回FAIL重新申请
    Log::DEBUG($result);
    echo "SUCCESS";
} catch (Exception $e){
    echo "FAIL";
    Log::DEBUG($e->getMessage());
}
echo "SUCCESS";