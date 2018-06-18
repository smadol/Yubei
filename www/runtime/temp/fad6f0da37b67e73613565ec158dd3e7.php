<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:83:"D:\phpStudy\PHPTutorial\WWW\yubei\www\public/../application/view\user\security.html";i:1528863227;s:66:"D:\phpStudy\PHPTutorial\WWW\yubei\www\application\view\layout.html";i:1526126700;s:73:"D:\phpStudy\PHPTutorial\WWW\yubei\www\application\view\common\header.html";i:1528426891;s:73:"D:\phpStudy\PHPTutorial\WWW\yubei\www\application\view\common\footer.html";i:1528130949;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Xenon Boostrap Admin Panel" />
    <meta name="author" content="" />
    <title>商户平台|余呗支付 - 聚合支付系统服务商</title>
    <link rel="stylesheet" href="/assets/css/fonts/linecons/css/linecons.css">
    <link rel="stylesheet" href="/assets/css/fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/xenon-core.css">
    <link rel="stylesheet" href="/assets/css/xenon-forms.css">
    <link rel="stylesheet" href="/assets/css/xenon-components.css">
    <link rel="stylesheet" href="/assets/css/xenon-skins.css">
    <link rel="stylesheet" href="/assets/css/custom.css">
    <!-- toast -->
    <script src="/assets/js/jquery-1.11.1.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="page-body">
<!--加载动画-->
<div class="page-loading-overlay">
    <div class="loader-1"></div>
</div>

<div class="page-container">

    <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
    <!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
    <!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
    <div class="sidebar-menu toggle-others">
        <div class="sidebar-menu-inner">
            <header class="logo-env">
                <!-- logo -->
                <div class="logo">
                    <a href="/" class="logo-expanded">
                        <img src="/static/logo-white.png" width="140" alt="" />
                    </a>

                    <a href="/" class="logo-collapsed">
                        <img src="/assets/images/logo-collapsed@2x.png" width="40" alt="" />
                    </a>
                </div>
                <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
                <div class="mobile-menu-toggle visible-xs">
                    <a href="#" data-toggle="mobile-menu">
                        <i class="fa-bars"></i>
                    </a>
                </div>
            </header>
            <script>
                var className = '<?php echo \think\Request::instance()->controller(); ?>-<?php echo \think\Request::instance()->action(); ?>'
                $("."+className).addClass('active');
                $("."+className).parent().parent().addClass('active open');
                $("."+className).parent().show();
            </script>
            <!--    侧边菜单栏-->
            <ul id="main-menu" class="main-menu">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                <li class="<?php if(\think\Request::instance()->controller() == 'Index'): ?>opened active<?php endif; ?>">
                    <a href="/">
                        <i class="linecons-desktop"></i>
                        <span class="title">数据中心</span>
                    </a>
                </li>
                <li class="<?php if(\think\Request::instance()->controller() == 'Order'): ?>opened active<?php endif; ?>">
                    <a href="<?php echo url('app/Order/index'); ?>">
                        <i class="linecons-mail"></i>
                        <span class="title">交易管理</span>
                    </a>
                    <ul>
                        <li class="<?php if(\think\Request::instance()->controller() == 'Order' && \think\Request::instance()->action() == 'index'): ?>active<?php endif; ?>">
                            <a href="<?php echo url('app/Order/index'); ?>">
                                <span class="title">支付查询</span>
                            </a>
                        </li>
                        <li class="<?php if(\think\Request::instance()->controller() == 'Order' && \think\Request::instance()->action() == 'refund'): ?>active<?php endif; ?>">
                            <a href="<?php echo url('app/Order/refund'); ?>">
                                <span class="title">退款查询</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?php if(\think\Request::instance()->controller() == 'Settle'): ?>opened active<?php endif; ?>">
                    <a href="#">
                        <i class="linecons-database"></i>
                        <span class="title">结算管理</span>
                    </a>
                    <ul>
                        <li class="<?php if(\think\Request::instance()->controller() == 'Settle' && \think\Request::instance()->action() == 'index'): ?>active<?php endif; ?>">
                            <a href="<?php echo url('app/Settle/index'); ?>">
                                <span class="title">结算查询</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?php if(\think\Request::instance()->controller() == 'Asset'): ?>opened active<?php endif; ?>">
                    <a href="<?php echo url('app/Asset/index'); ?>">
                        <i class="linecons-params"></i>
                        <span class="title">资金管理</span>
                    </a>
                    <ul>
                        <li class="<?php if(\think\Request::instance()->controller() == 'Asset' && \think\Request::instance()->action() == 'index'): ?>active<?php endif; ?>">
                            <a href="<?php echo url('app/Asset/index'); ?>">
                                <span class="title">资金记录</span>
                            </a>
                        </li>
                        <li class="<?php if(\think\Request::instance()->controller() == 'Asset' && \think\Request::instance()->action() == 'account'): ?>active<?php endif; ?>">
                            <a href="<?php echo url('app/Asset/account'); ?>">
                                <span class="title">取现账户</span>
                            </a>
                        </li>
                        <li class="<?php if(\think\Request::instance()->controller() == 'Asset' && \think\Request::instance()->action() == 'apply'): ?>active<?php endif; ?>">
                            <a href="<?php echo url('app/Asset/apply'); ?>">
                                <span class="title">取现申请</span>
                            </a>
                        </li>
                        <li class="<?php if(\think\Request::instance()->controller() == 'Asset' && \think\Request::instance()->action() == 'cash'): ?>active<?php endif; ?>">
                            <a href="<?php echo url('app/Asset/cash'); ?>">
                                <span class="title">取现记录</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?php if(\think\Request::instance()->controller() == 'User'): ?>opened active<?php endif; ?>">
                    <a href="<?php echo url('app/User/index'); ?>">
                        <i class="linecons-beaker"></i>
                        <span class="title">商户中心</span>
                    </a>
                    <ul>
                        <li class="<?php if(\think\Request::instance()->controller() == 'User' && \think\Request::instance()->action() == 'index'): ?>active<?php endif; ?>">
                            <a href="<?php echo url('app/User/index'); ?>">
                                <span class="title">基本信息</span>
                            </a>
                        </li>
                        <li class="<?php if(\think\Request::instance()->controller() == 'User' && \think\Request::instance()->action() == 'security'): ?>active<?php endif; ?>">
                            <a href="<?php echo url('app/User/security'); ?>">
                                <span class="title">安全信息</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!--    /侧边菜单栏-->
        </div>

    </div>

    <div class="main-content">

        <!-- User Info, Notifications and Menu Bar -->
        <nav class="navbar user-info-navbar" role="navigation">

            <!-- Left links for user info navbar -->
            <ul class="user-info-menu left-links list-inline list-unstyled">

                <li class="hidden-sm hidden-xs">
                    <a href="#" data-toggle="sidebar">
                        <i class="fa-bars"></i>
                    </a>
                </li>

            </ul>

            <!-- Right links for user info navbar -->
            <ul class="user-info-menu right-links list-inline list-unstyled">
                <li class="dropdown user-profile">
                    <a href="#" data-toggle="dropdown">
                        <img src="/assets/images/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
                        <span>
                            <?php echo $userinfo['username']; ?>
                            <i class="fa-angle-down"></i>
                        </span>
                    </a>

                    <ul class="dropdown-menu user-profile-menu list-unstyled">
                        <li class="last">
                            <a href="<?php echo url('app/Login/quit'); ?>">
                                <i class="fa-lock"></i>
                                退出
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#" data-toggle="chat">
                        <i class="fa-comments-o"></i>
                    </a>
                </li>

            </ul>

        </nav>


<div class="page-title">

    <div class="title-env">
        <h1 class="title">商户中心</h1>
        <p class="description">商户API信息</p>
    </div>

    <div class="breadcrumb-env">

        <ol class="breadcrumb bc-1">
            <li>
                <a href="/"><i class="fa-home"></i>商户平台</a>
            </li>
            <li>

                <a href="#">商户中心</a>
            </li>
            <li class="active">

                <strong>商户API信息</strong>
            </li>
        </ol>

    </div>

</div>
<section class="profile-env">

    <div class="row">

        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">商户API信息</h3>
                </div>
                <div class="panel-body">
                    <form id="api_edit" method="POST" enctype="multipart/form-data" role="form" class="form-horizontal">
                        <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />
                        <div class="form-group">
                            <label class="col-sm-2 control-label" >商户UID:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" readonly value="<?php echo (isset($api['uid']) && ($api['uid'] !== '')?$api['uid']:'100000'); ?>">
                            </div>
                        </div>
                        <div class="form-group-separator"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" >支付API接口:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" readonly value="https://api.yubei.cn/pay/unifiedorder">
                            </div>
                        </div>
                        <div class="form-group-separator"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" >商户KEY</label>
                            <div class="col-sm-6">
                                <input type="text" name="key" class="form-control" disabled value="<?php echo (isset($api['key']) && ($api['key'] !== '')?$api['key']:'提交私钥后自动生成'); ?>" >
                                <p class="help-block">更改私钥的同时，KEY也会自动更改，请注意在SDK也一同更改.</p>
                            </div>
                        </div>
                        <div class="form-group-separator"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" >平台公钥</label>
                            <div class="col-sm-6"><button type="button">点击下载平台公钥</button></div>
                        </div>
                        <div class="form-group-separator"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" >商户公钥</label>
                            <div class="col-sm-6">
                                <textarea class="form-control autogrow" name="rsakey" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"><?php echo (isset($api['secretkey']) && ($api['secretkey'] !== '')?$api['secretkey']:'提交私钥后自动生成'); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group-separator"></div>
                        <div class="form-group">
                            <label class="col-sm-2"></label>
                            <button class="btn btn-success btn-icon">
                                <i class="fa-check"></i>
                                <span>修改商户公钥</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <!-- Modal-->
        <div class="modal fade" id="rsakey">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Modal Content is Responsive</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group no-margin">
                                    <label for="field-7" class="control-label">Personal Info</label>

                                    <textarea class="form-control autogrow" id="field-7" placeholder="Write something about yourself"></textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
        <!-- Main Footer -->
        <!-- Choose between footer styles: "footer-type-1" or "footer-type-2" -->
        <!-- Add class "sticky" to  always stick the footer to the end of page (if page contents is small) -->
        <!-- Or class "fixed" to  always fix the footer to the end of page -->
        <footer class="main-footer sticky footer-type-1">

            <div class="footer-inner">

                <!-- Add your copyright text here -->
                <div class="footer-text">
                    &copy; <?php echo date('Y'); ?><strong>YuBei支付</strong>
                </div>


                <!-- Go to Top Link, just add rel="go-top" to any link to add this functionality -->
                <div class="go-up">

                    <a href="#" rel="go-top">
                        <i class="fa-angle-up"></i>
                    </a>

                </div>

            </div>

        </footer>
    </div>
</div>



<!-- Imported styles on this page -->
<!--<link rel="stylesheet" href="/assets/css/fonts/meteocons/css/meteocons.css">-->

<!-- Bottom Scripts -->
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/TweenMax.min.js"></script>
<script src="/assets/js/resizeable.js"></script>
<script src="/assets/js/joinable.js"></script>
<script src="/assets/js/xenon-api.js"></script>
<script src="/assets/js/xenon-toggles.js"></script>

<!-- JavaScripts initializations and stuff -->
<script src="/assets/js/xenon-custom.js"></script>
<!--layer-->
<script type="text/javascript" src="/static/layer/layer.js"></script>


</body>
</html>