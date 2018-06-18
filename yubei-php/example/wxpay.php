<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class=""> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit">
    <title>立即支付</title>

    <link rel="stylesheet" media="screen" href="css/pay.css"/>
    <link rel="stylesheet" media="screen" href="css/font-awesome.min_1.css"/>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div class="container">
    <div class="header">
        <div class="logo wechat"></div>
    </div>
    <div class="mainbody">
        <div class="realprice">￥0.02</div>
        <div class="warning hidden">扫码后请务必手动输入金额</div>
        <div class="qrcode">
            <img class="image" src="images/5f02be5400de4b059090fbe22a36f770.gif" alt="">
            <div class="logo hidden-xs logo-wechat"></div>
            <div class="expired hidden"></div>
            <div class="paid hidden"></div>
        </div>
        <div class="remainseconds">
            <div class="time minutes">
                <b>00</b>
                <em>分</em>
            </div>
            <div class="colon">:</div>
            <div class="time seconds">
                <b>00</b>
                <em>秒</em>
            </div>
        </div>

        <div class="help">
            支付即时到账，未到账请与我们联系，订单号：fdb81fef215d72d9620378be831f24c0<br />
            <a href=""><img src="images/logo-alipay.png" alt="" width="16" height="16"> 支付宝请点击这里</a>
        </div>

        <div class="tips">
            打开微信「扫一扫」
        </div>
    </div>

    <script>
        var order = {"order_id":"4702","out_order_id":"fdb81fef215d72d9620378be831f24c0","price":"0.01","realprice":"0.02","discountprice":"-0.01","extend":"custom","type":"wechat","remainseconds":193,"status":"inprogress","manual":false,"returnurl":"https:\/\/www.fastadmin.net\/addons\/pay\/index\/returnit.html?order_id=4702&out_order_id=fdb81fef215d72d9620378be831f24c0&sign=b0029708cb1470fa952e4a25642e1758","payurl":"","queryurl":"http://sirhe.cn","qrcodeurl":"wxp:\/\/f2f1YRtrmqFLahIvImW2rMbysz5wYJERPqxb","wechaturl":"","alipayurl":""};
        var addon = {successtips:"支付成功!请关闭当前窗口以便于继续操作!", expiretips:"二维码已过期,请点击这里刷新后重新尝试支付!", jumptips:"支付成功!2秒后将自动跳转!"}
    </script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/pay.js"></script>
</div>
</body>
</html>
