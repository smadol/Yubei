<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:81:"D:\phpStudy\PHPTutorial\WWW\yubei\www\public/../application/view\index\index.html";i:1528204696;s:66:"D:\phpStudy\PHPTutorial\WWW\yubei\www\application\view\layout.html";i:1526126700;s:73:"D:\phpStudy\PHPTutorial\WWW\yubei\www\application\view\common\header.html";i:1528426891;s:73:"D:\phpStudy\PHPTutorial\WWW\yubei\www\application\view\common\footer.html";i:1528130949;}*/ ?>
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


        <div class="row">

            <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter-gray" data-count=".num" data-from="0.00" data-to="<?php echo $asset['asset'] + $asset['available']; ?>" data-prefix="￥" data-duration="2">
                    <div class="xe-icon">
                        <i class="linecons-cloud"></i>
                    </div>
                    <div class="xe-label">
                        <strong class="num">0.00</strong>
                        <span>总余额</span>
                    </div>
                </div>

            </div>
            <div class="col-sm-3">

                <div class="xe-widget xe-counter" data-count=".num" data-from="0.00" data-to="<?php echo $asset['asset']; ?>" data-prefix="￥" data-duration="2">
                    <div class="xe-icon">
                        <i class="linecons-paper-plane"></i>
                    </div>
                    <div class="xe-label">
                        <strong class="num">0.00</strong>
                        <span>可提现金额</span>
                    </div>
                </div>

            </div>
            <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter-blue" data-count=".num" data-from="0.00" data-to="<?php echo $asset['available']; ?>" data-prefix="￥" data-duration="2">
                    <div class="xe-icon">
                        <i class="linecons-paper-plane"></i>
                    </div>
                    <div class="xe-label">
                        <strong class="num">0.00</strong>
                        <span>待结算金额</span>
                    </div>
                </div>

            </div>
            <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter-red" data-count=".num" data-from="0" data-to="<?php echo $asset['disable']; ?>" data-prefix="￥" data-duration="5">
                    <div class="xe-icon">
                        <i class="linecons-lightbulb"></i>
                    </div>
                    <div class="xe-label">
                        <strong class="num">0.00</strong>
                        <span>待支付金额</span>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        账户基本信息
                    </div>
                    <div class="panel-body">
                        <div class="same-margin">
                            <h3>商户UID:<br><small><?php echo $userinfo['uid']; ?></small></h3>
                            <h3>商户邮箱:<br><small><?php echo $userinfo['username']; ?></small></h3>
                            <h3>商户名称:<br><small><?php echo $userinfo['realname']; ?></small></h3>
                            <h3>商户联系:<br><small><?php echo $userinfo['phone']; ?></small></h3>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4">

                <!-- Default panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        一码支付
                    </div>
                    <div class="panel-body">
                        <img style="width:auto;height:auto;max-width:100%;max-height:100%;" src="<?php echo $qrcode; ?>" />
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="xe-widget xe-conversations">
                    <div class="xe-bg-icon">
                        <i class="linecons-comment"></i>
                    </div>
                    <div class="xe-header">
                        <div class="xe-icon">
                            <i class="linecons-comment"></i>
                        </div>
                        <div class="xe-label">
                            <h4>
                                最新公告
                            </h4>
                        </div>
                    </div>
                    <div class="xe-body">

                        <ul class="list-unstyled">
                            <?php if($notice): foreach($notice as $v): ?>
                                <li>
                                    <div class="xe-comment-entry">
                                        <div class="xe-comment">
                                            <p><?php echo $v['content']; ?></p>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; else: ?>
                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <p>管理员太懒了，没发公告~</p>
                                    </div>
                                </div>
                            </li>
                            <?php endif; ?>
                        </ul>

                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <script type="text/javascript">
                            $(document).ready(function()
                            {
                                function between(randNumMin, randNumMax)
                                {
                                    var randInt = Math.floor((Math.random() * ((randNumMax + 1) - randNumMin)) + randNumMin);

                                    return randInt;
                                }
                                //array(7) { [0]=> int(1) [1]=> int(1) [2]=> int(0) [3]=> int(0) [4]=> int(0) [5]=> int(0) [6]=> int(0) }

                                $("#order-chart").dxChart({
                                    dataSource: [
                                        { day: '周一', order: "<?php echo($chart['0']); ?>",refund:between(0,10)},
                                        { day: '周二', order: "<?php echo($chart['1']); ?>",refund:between(0,10)},
                                        { day: '周三', order: "<?php echo($chart['2']); ?>",refund:between(0,10)},
                                        { day: '周四', order: "<?php echo($chart['3']); ?>",refund:between(0,10)},
                                        { day: '周五', order: "<?php echo($chart['4']); ?>",refund:between(0,10)},
                                        { day: '周六', order: "<?php echo($chart['5']); ?>",refund:between(0,10)},
                                        { day: '周日', order: "<?php echo($chart['6']); ?>",refund:between(0,10)}
                                    ],
                                    commonSeriesSettings: {
                                        argumentField: "day"
                                    },
                                    series: [
                                        { valueField: "order", name: "订单数", color: "#40bbea" },
                                        { valueField: "refund", name: "退款单", color: "#68b828" }
                                    ],
                                    argumentAxis:{
                                        grid:{
                                            visible: true
                                        }
                                    },
                                    tooltip:{
                                        enabled: true
                                    },
                                    title: "本周交易折线图",
                                    legend: {
                                        verticalAlignment: "bottom",
                                        horizontalAlignment: "center"
                                    },
                                    commonPaneSettings: {
                                        border:{
                                            visible: true,
                                            right: false
                                        }
                                    }
                                });
                            });
                        </script>
                        <div id="order-chart" style="height: 400px; width: 100%; user-select: none;" class="dx-visibility-change-handler">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Imported scripts on this page -->
        <script src="/assets/js/devexpress-web-14.1/js/globalize.min.js"></script>
        <script src="/assets/js/devexpress-web-14.1/js/dx.chartjs.js"></script>
        <script src="/assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="/assets/js/jvectormap/regions/jquery-jvectormap-world-mill-en.js"></script>
        <script src="/assets/js/xenon-widgets.js"></script>

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