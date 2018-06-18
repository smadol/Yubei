<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:81:"D:\phpStudy\PHPTutorial\WWW\yubei\www\public/../application/view\asset\index.html";i:1528175684;s:66:"D:\phpStudy\PHPTutorial\WWW\yubei\www\application\view\layout.html";i:1526126700;s:73:"D:\phpStudy\PHPTutorial\WWW\yubei\www\application\view\common\header.html";i:1528426891;s:73:"D:\phpStudy\PHPTutorial\WWW\yubei\www\application\view\common\footer.html";i:1528130949;}*/ ?>
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


<!-- Imported scripts on this page -->
<script src="/assets/js/rwd-table/js/rwd-table.min.js"></script>
<script src="/assets/js/datatables/js/jquery.dataTables.min.js"></script>

<!-- Imported scripts on this page -->
<script src="/assets/js/datatables/dataTables.bootstrap.js"></script>
<script src="/assets/js/datatables/yadcf/jquery.dataTables.yadcf.js"></script>
<script src="/assets/js/datatables/tabletools/dataTables.tableTools.min.js"></script>

<script src="/assets/js/table-export/xlsx.core.min.js"></script>
<script src="/assets/js/table-export/blob.js"></script>
<script src="/assets/js/table-export/FileSaver.min.js"></script>
<script src="/assets/js/table-export/tableexport.js"></script>


<div class="page-title">
    <div class="title-env">
        <h1 class="title">资金管理</h1>
        <p class="description">资金变动记录</p>
    </div>
    <div class="breadcrumb-env">

        <ol class="breadcrumb bc-1">
            <li>
                <a href="/"><i class="fa-home"></i>商户平台</a>
            </li>
            <li>
                <a href="#">资金管理</a>
            </li>
            <li class="active">
                <strong>资金变动记录</strong>
            </li>
        </ol>

    </div>

</div>
<section class="profile-env">
    <div class="row">
        <div class="col-md-12">
            <!-- Removing search and results count filter -->
            <div class="panel panel-default">
                <div class="panel-heading btn-toolbar">
                    <h3 class="panel-title">资金变动记录</h3>
                </div>
                <div class="panel-body">
                    <!-- searach -->
                    <div class="btn-toolbar">

                        <form method="get" class="form-inline search-tool" style="margin-bottom:15px;">
                            <span style="margin-left: 15px;">
                                <label class="control-label">订单编号</label>
                                <input type="text" class="form-control" placeholder="订单编号" name="assets_no" value="<?php echo \think\Request::instance()->get('assets_no'); ?>" />
                            </span>
                            <span style="margin-left: 15px;">
                                <label class="control-label">时间选择</label>
                                <input name="time" value="<?php echo \think\Request::instance()->get('time'); ?>" placeholder="时间选择" type="text" id="field-2" class="form-control daterange" data-format="YYYY-MM-DD"  data-separator="/" />
                            </span>
                            <span style="margin-left: 15px;">
                                    <label class="control-label">支付渠道</label>
                                    <select class="form-control" name="channel">
                                        <option value="" <?php if(\think\Request::instance()->get('channel') == ''): ?> selected="selected" <?php endif; ?>>全部</option>
                                        <option value="WXPAY" <?php if(\think\Request::instance()->get('channel') == 'WXPAY'): ?> selected="selected" <?php endif; ?>>微信支付</option>
                                        <option value="ALIPAY" <?php if(\think\Request::instance()->get('channel') == 'ALIPAY'): ?> selected="selected" <?php endif; ?>>支付宝支付</option>
                                    </select>
                                </span>
                            <span style="margin-left: 15px;">
                                <label class="control-label">订单状态</label>
                                <select class="form-control" name="status">
                                    <option value="" <?php if(\think\Request::instance()->get('status') == ' '): ?> selected="selected" <?php endif; ?>>全部</option>
                                    <option value="0" <?php if(\think\Request::instance()->get('status') == '0'): ?> selected="selected" <?php endif; ?>>待支付</option>
                                    <option value="1" <?php if(\think\Request::instance()->get('status') == '1'): ?> selected="selected" <?php endif; ?>>已支付</option>
                                </select>
                            </span>

                            <span style="margin-left: 15px;">
                                <button class="btn btn-default btn-primary" type="submit" style="margin-top:10px;">
                                    <span class="fa-search"></span> 搜 索
                                </button>
                            </span>

                        </form>

                    </div>
                    <!-- searach -->
                    <table class="table table-bordered table-striped" id="支付订单">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>变动记录单号</th>
                            <th>变动前金额</th>
                            <th>增加金额</th>
                            <th>减少金额</th>
                            <th>变动后金额</th>
                            <th>备注</th>
                            <th>创建时间</th>
                            <th>更新时间</th>
                        </tr>
                        </thead>

                        <tbody class="middle-align">
                        <?php foreach($list as $vo): ?>
                        <tr>
                            <td> <?php echo $vo['id']; ?> </td>
                            <td> <?php echo $vo['assets_no']; ?> </td>
                            <td> <?php echo $vo['preinc']; ?> </td>
                            <td> <?php echo $vo['increase']; ?> </td>
                            <td> <?php echo $vo['reduce']; ?> </td>
                            <td> <?php echo $vo['suffixred']; ?> </td>
                            <td> <span style="color:#060;"><?php echo $vo['remarks']; ?></span> </td>
                            <td> <?php echo $vo['create_time']; ?> </td>
                            <td> <?php echo $vo['update_time']; ?> </td>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="dataTables_info" id="example-3_info" role="status" aria-live="polite"> 共 <?php echo count($list); ?> 行数据</div></div>
                        <div class="col-xs-6">
                            <div class="dataTables_paginate paging_simple_numbers" id="example-3_paginate">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Imported styles on this page -->
<link rel="stylesheet" href="/assets/js/daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="/assets/js/select2/select2.css">
<link rel="stylesheet" href="/assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="/assets/js/multiselect/css/multi-select.css">

<script src="/assets/js/moment.min.js"></script>


<!-- Imported scripts on this page -->
<script src="/assets/js/daterangepicker/daterangepicker.js"></script>
<script src="/assets/js/datepicker/bootstrap-datepicker.js"></script>
<script src="/assets/js/timepicker/bootstrap-timepicker.min.js"></script>
<script src="/assets/js/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="/assets/js/select2/select2.min.js"></script>
<script src="/assets/js/jquery-ui/jquery-ui.min.js"></script>
<script src="/assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
<script src="/assets/js/tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="/assets/js/typeahead.bundle.js"></script>
<script src="/assets/js/handlebars.min.js"></script>
<script src="/assets/js/multiselect/js/jquery.multi-select.js"></script>
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