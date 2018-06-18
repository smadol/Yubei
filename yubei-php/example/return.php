<?php
require dirname(__FILE__) . '/../init.php';
//同步回调
Log::Init();
//以下写入业务逻辑
try {
    Log::DEBUG("支付成功跳转地址");
} catch (Exception $ex) {
    Log::ERROR("Errror:" . json_encode($ex));
    return false;
}
echo "支付成功！";
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>余呗聚合支付</title>
	</head>
    <body>
    </body>
</html>
