<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\phpStudy\PHPTutorial\WWW\yubei\www\public/../application/view\login\index.html";i:1527865767;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Xenon Boostrap Admin Panel" />
    <meta name="author" content="" />

    <title>商户平台 - 登录平台</title>

    <!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo:400,700,400italic">-->
    <link rel="stylesheet" href="/assets/css/fonts/linecons/css/linecons.css">
    <link rel="stylesheet" href="/assets/css/fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/xenon-core.css">
    <link rel="stylesheet" href="/assets/css/xenon-forms.css">
    <link rel="stylesheet" href="/assets/css/xenon-components.css">
    <link rel="stylesheet" href="/assets/css/xenon-skins.css">
    <link rel="stylesheet" href="/assets/css/custom.css">

    <script src="/assets/js/jquery-1.11.1.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body class="page-body login-page">


<div class="login-container">

    <div class="row">

        <div class="col-sm-6">
            <!-- Errors container -->
            <div class="errors-container">

            </div>

            <form method="post" role="form" id="login" class="login-form fade-in-effect">
                <div class="login-header">
                    <a href="/" class="logo">
                        <img src="/static/logo-white.png" alt="商户平台" width="180" />
                        <span>商户平台</span>
                    </a>
                    <p>欢迎使用，余呗商户平台！</p>
                </div>
                <div class="form-group">
                    <label class="control-label" for="username">商户登录邮箱</label>
                    <input type="text" class="form-control" name="username" id="username" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label class="control-label" for="password">商户登录密码</label>
                    <input type="password" class="form-control" name="password" id="password" autocomplete="off" />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-turquoise btn-block text-center">
                        <i class="fa-lock"></i>
                        商 户 登 录
                    </button>
                </div>

                <div class="login-footer">
                    <a href="#">忘记登录密码?</a> 或者 <a href="http://wpa.qq.com/msgrd?v=3&uin=702154416&site=qq&menu=yes" target="_blank">申请成为商户?</a>
                    <div class="info-links">
                        <a href="#">服务条款</a> - <a href="#">隐私协议</a>
                    </div>

                </div>
            </form>

        </div>

    </div>

</div>



<!-- Bottom Scripts -->
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/TweenMax.min.js"></script>
<script src="/assets/js/resizeable.js"></script>
<script src="/assets/js/joinable.js"></script>
<script src="/assets/js/xenon-api.js"></script>
<script src="/assets/js/xenon-toggles.js"></script>
<script src="/assets/js/jquery-validate/jquery.validate.min.js"></script>
<script src="/assets/js/toastr/toastr.min.js"></script>


<!-- JavaScripts initializations and stuff -->
<script src="/assets/js/xenon-custom.js"></script>
<!--  Page JavaScripts  -->
<script src="/assets/js/login.js"></script>
</body>
</html>