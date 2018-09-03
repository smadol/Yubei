<?php
date_default_timezone_set('PRC');
?><!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="th=device-th, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="MoPay">
    <title>支付测试</title>
    <link rel="apple-touch-icon" href="https://www.98imo.com/favicon.png">
    <link rel="shortcut icon" href="https://www.98imo.com/favicon.ico">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://my.zllyun.com/templates/zhiliaoyun/assets/css/bootstrap.min.css?t=201803131635">
    <link rel="stylesheet" href="https://my.zllyun.com/templates/zhiliaoyun/assets/css/site.min.css?t=201803131635?v=2.5">
    <!-- Javascript-->
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div class="page-content ">
    <div class="row">
        <div class="col-xxl-12 col-lg-12 col-xs-12 product-invoice  p-t-10  p-l-15">
            <!-- Panel -->
            <div class="panel p-b-40 col-lg-12 col-xs-12  h-600">
                <div class="panel-body container-fluid p-l-15 p-r-15">
                    <div class="row ">
                        <form id="payment" method="post" action="order.php" target="_blank" >
                            <input hidden="hidden" name="action" value="gateway" />
                            <div class="form-group row">
                                <label class="col-xs-3 col-md-2 form-control-label addfund-bt">商品名称: </label>
                                <div class="col-md-4 col-xs-6">
                                    <input type="text" name="subject" id="subject" value="支付测试" class="form-control" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-3 col-md-2 form-control-label addfund-bt">支付单号: </label>
                                <div class="col-md-4 col-xs-6">
                                    <input type="text" name="out_trade_no" id="out_trade_no" value="<?php echo date('YmdHis').mt_rand(1000,9999) ?>" class="form-control" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-3 col-md-2 form-control-label addfund-bt">支付金额: </label>
                                <div class="col-md-4 col-xs-6">
                                    <input type="text" name="amount" id="total_fee" value="100" class="form-control" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-3 col-md-2 form-control-label addfund-bt">支付方式: </label>
                                <div class="col-md-9 col-xs-6">
                                    <input type="hidden" id="channel" name="channel" value="">
                                    <ul>
                                        <li class="local-item col-sm-3 p-l-0 p-r-0 pay_method m-r-10">
                                            <a><div class="weixinpay" value="wx_scan"></div><p class="hk-bt"></p></a>
                                        </li>
                                        <script type="text/javascript">
                                            $(function(){
                                                $(".pay_method").click(function(){
                                                    var payway=$(this).find("div").attr("value");
                                                    $("input[name='channel']").attr("value",payway);
                                                });
                                                $(".pay_method").click(function(){
                                                    $(this).siblings("li").find("a").css("border-color","#f2f2f2 ");
                                                    $(this).find("a").css("border-color","#46be8a");
                                                });
                                            });
                                        </script>

                                    </ul>
                                </div>
                                <label class="col-xs-6 col-md-2 form-control-label m-t-10"> </label>
                                <div class="col-md-9 col-xs-6  m-t-15">
                                    <button type="submit" class="btn btn-animate btn-animate-side btn-success">支付</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="qr-image" id="qrcode"></div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- End Panel -->
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- End get Linepoint -->
</div>
<!-- Footer -->
</body>
</html>