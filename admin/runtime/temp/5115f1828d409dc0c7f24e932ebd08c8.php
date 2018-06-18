<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:75:"D:\phpStudy\PHPTutorial\WWW\yubei\admin\public/../app/view\index\index.html";i:1528470730;s:60:"D:\phpStudy\PHPTutorial\WWW\yubei\admin\app\view\layout.html";i:1525744882;s:67:"D:\phpStudy\PHPTutorial\WWW\yubei\admin\app\view\public\header.html";i:1528429378;s:65:"D:\phpStudy\PHPTutorial\WWW\yubei\admin\app\view\public\menu.html";i:1525744882;s:67:"D:\phpStudy\PHPTutorial\WWW\yubei\admin\app\view\public\footer.html";i:1525744882;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Xenon Boostrap Admin Panel" />
	<meta name="author" content="" />
	
	<title><?php echo (isset($_site['name']) && ($_site['name'] !== '')?$_site['name']:'余呗支付管理平台'); ?></title>

	<link rel="stylesheet" href="__STATIC__/css/fonts/linecons/css/linecons.css">
	<link rel="stylesheet" href="__STATIC__/css/fonts/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="__STATIC__/css/bootstrap.css">
	<link rel="stylesheet" href="__STATIC__/css/xenon-core.css">
	<link rel="stylesheet" href="__STATIC__/css/xenon-forms.css">
	<link rel="stylesheet" href="__STATIC__/css/xenon-components.css">
	<link rel="stylesheet" href="__STATIC__/css/xenon-skins.css">
	<link rel="stylesheet" href="__STATIC__/css/custom.css">

	<script src="__STATIC__/js/jquery-1.11.1.min.js"></script>

	<!-- toast -->
	<link rel="stylesheet" type="text/css" href="__STATIC__/js/toastr/toastr.css" />
	<script type="text/javascript" src="__STATIC__/js/toastr/toastr.js"></script>

	<script type="text/javascript" src="__STATIC__/js/common.js"></script>


	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
</head>
<body class="page-body">

	<div class="page-container">
	<!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
			
		<!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
		<!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
		<!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
		<div class="sidebar-menu toggle-others fixed">
			
			<div class="sidebar-menu-inner">	
				
				<header class="logo-env">
					
					<!-- logo -->
					<div class="logo">
						<a href="" class="logo-expanded">
							<img src="__STATIC__/logo-white.png" alt="" width="120" />
						</a>
						
						<a href="" class="logo-collapsed">
							<img src="__STATIC__/images/logo-collapsed@2x.png" width="40" alt="" />
						</a>
					</div>
					
					<!-- This will toggle the mobile menu and will be visible only on mobile devices -->
					<div class="mobile-menu-toggle visible-xs">
						<a href="#" data-toggle="user-info-menu">
							<i class="fa-bell-o"></i>
							<span class="badge badge-success">7</span>
						</a>
						
						<a href="#" data-toggle="mobile-menu">
							<i class="fa-bars"></i>
						</a>
					</div>
					
								
				</header>
						
				
				<!-- 菜单 -->
				<?php
$request= \think\Request::instance();

?>
				<ul id="main-menu" class="main-menu">

					<?php if(is_array($_menuList['father']) || $_menuList['father'] instanceof \think\Collection || $_menuList['father'] instanceof \think\Paginator): $i = 0; $__LIST__ = $_menuList['father'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<li>
							<a href="<?php echo url($vo->controller.'/'.$vo->action); ?>">
								<i class="<?php echo $vo['ico']; ?>"></i>
								<span class="title"><?php echo $vo['name']; ?></span>
							</a>
							<?php if($vo['controller'] == ''): ?>
							<ul>
							<?php if(is_array($_menuList['child']) || $_menuList['child'] instanceof \think\Collection || $_menuList['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $_menuList['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;if($vv['pid'] == $vo['id']): ?>
									<li class=" <?php echo $vv->controller; ?>-<?php echo $vv->action; ?>">
										<a href="<?php echo url($vv->controller.'/'.$vv->action); ?>"><span class="title"><?php echo $vv['name']; ?></span></a>
									</li>
								<?php else: endif; endforeach; endif; else: echo "" ;endif; ?>
							</ul>
							<?php endif; ?>

						</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
			
				</ul>


<script>
	var className = '<?php echo $request->controller(); ?>-<?php echo $request->action(); ?>'
	$("."+className).addClass('active');
	$("."+className).parent().parent().addClass('active open');
	$("."+className).parent().show();
</script>
						
			</div>
			
		</div>
		

		<div class="main-content">
					
			<!-- User Info, Notifications and Menu Bar -->
			<nav class="navbar user-info-navbar" role="navigation">
				
				<!-- Left links for user info navbar -->
				<ul class="user-info-menu left-links list-inline list-unstyled">
					
					<li class="hidden-sm hidden-xs">
						<a href="#" data-toggle="sidebar">
							<!-- <i class="fa-bars"></i> -->
						</a>
					</li>
					
					<li class="dropdown hover-line">
						<a href="#" data-toggle="dropdown">
							<i class="fa-envelope-o"></i>
							<span class="badge badge-green">15</span>
						</a>
							
						<ul class="dropdown-menu messages">
							<li>
									
								<ul class="dropdown-menu-list list-unstyled ps-scrollbar">
								
									<li class="active"><!-- "active" class means message is unread -->
										<a href="#">
											<span class="line">
												<strong>吕克Chartier</strong>
												<span class="light small">- 昨天</span>
											</span>
											
											<span class="line desc small">
												这不是我们的第一个项目，它是其余最好的.
											</span>
										</a>
									</li>
									
									<li class="active">
										<a href="#">
											<span class="line">
												<strong>萨尔玛Nyberg</strong>
												<span class="light small">- 2天前</span>
											</span>
											
											<span class="line desc small">
												哦，他果断地认为友谊如此依恋一切. 
											</span>
										</a>
									</li>
									
									<li>
										<a href="#">
											<span class="line">
												海登卡特赖特
												<span class="light small">- 一个星期前</span>
											</span>
											
											<span class="line desc small">
												谁是她的新主人。如果你需要同样的怀疑.
											</span>
										</a>
									</li>
									
									<li>
										<a href="#">
											<span class="line">
												桑德拉艾伯
												<span class="light small">- 16天前</span>
											</span>
											
											<span class="line desc small">
												所以注意必须按规定否则存在的方向.
											</span>
										</a>
									</li>
									
									<!-- Repeated -->
									<!-- "active" class means message is unread -->
									<!-- <li class="active">
										<a href="#">
											<span class="line">
												<strong>Luc Chartier</strong>
												<span class="light small">- yesterday</span>
											</span>
											
											<span class="line desc small">
												This ain’t our first item, it is the best of the rest.
											</span>
										</a>
									</li>
									
									<li class="active">
										<a href="#">
											<span class="line">
												<strong>Salma Nyberg</strong>
												<span class="light small">- 2 days ago</span>
											</span>
											
											<span class="line desc small">
												Oh he decisively impression attachment friendship so if everything. 
											</span>
										</a>
									</li>
									
									<li>
										<a href="#">
											<span class="line">
												Hayden Cartwright
												<span class="light small">- a week ago</span>
											</span>
											
											<span class="line desc small">
												Whose her enjoy chief new young. Felicity if ye required likewise so doubtful.
											</span>
										</a>
									</li>
									
									<li>
										<a href="#">
											<span class="line">
												Sandra Eberhardt
												<span class="light small">- 16 days ago</span>
											</span>
											
											<span class="line desc small">
												On so attention necessary at by provision otherwise existence direction.
											</span>
										</a>
									</li> -->
									
								</ul>
								
							</li>
							
							<li class="external">
								<a href="blank-sidebar.html">
									<span>查看全部</span>
									<i class="fa-link-ext"></i>
								</a>
							</li>
						</ul>
					</li>
					

					<li class="dropdown hover-line">
						<a href="#" data-toggle="dropdown">
							<i class="fa-bell-o"></i>
							<span class="badge badge-purple">7</span>
						</a>
							
						<ul class="dropdown-menu notifications">
							<li class="top">
								<p class="small">
									<a href="#" class="pull-right">马克都读</a>
									你有 <strong>3</strong> 新通知.
								</p>
							</li>
							
							<li>
								<ul class="dropdown-menu-list list-unstyled ps-scrollbar">
									<li class="active notification-success">
										<a href="#">
											<i class="fa-user"></i>
											
											<span class="line">
												<strong>新用户注册</strong>
											</span>
											
											<span class="line small time">
												30秒前
											</span>
										</a>
									</li>
									
									<li class="active notification-secondary">
										<a href="#">
											<i class="fa-lock"></i>
											
											<span class="line">
												<strong>隐私设置已更改</strong>
											</span>
											
											<span class="line small time">
												3小时的针
											</span>
										</a>
									</li>
									
									<li class="notification-primary">
										<a href="#">
											<i class="fa-thumbs-up"></i>
											
											<span class="line">
												<strong>有人特别喜欢这个</strong>
											</span>
											
											<span class="line small time">
												2分钟前
											</span>
										</a>
									</li>
									<!-- 
									<li class="notification-danger">
										<a href="#">
											<i class="fa-calendar"></i>
											
											<span class="line">
												John cancelled the event
											</span>
											
											<span class="line small time">
												9 hours ago
											</span>
										</a>
									</li>
									
									<li class="notification-info">
										<a href="#">
											<i class="fa-database"></i>
											
											<span class="line">
												The server is status is stable
											</span>
											
											<span class="line small time">
												yesterday at 10:30am
											</span>
										</a>
									</li>
									
									<li class="notification-warning">
										<a href="#">
											<i class="fa-envelope-o"></i>
											
											<span class="line">
												New comments waiting approval
											</span>
											
											<span class="line small time">
												last week
											</span>
										</a>
									</li> -->
								</ul>
							</li>
							
							<li class="external">
								<a href="#">
									<span>查看全部通知</span>
									<i class="fa-link-ext"></i>
								</a>
							</li>
						</ul>
					</li>
					
				</ul>
				
				
				<!-- Right links for user info navbar -->
				<ul class="user-info-menu right-links list-inline list-unstyled">
					
					<!-- You can add "always-visible" to show make the search input visible -->
					<li class="search-form">
						
						<form method="get" action="extra-search.html">
							<input type="text" name="s" class="form-control search-field" placeholder="关键字..." />
							
							<button type="submit" class="btn btn-link">
								<i class="linecons-search"></i>
							</button>
						</form>
						
					</li>
					
					<li class="dropdown user-profile">
						<a href="#" data-toggle="dropdown">
							<img src="__STATIC__/images/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
							<span>
								<?php echo $_user->username; ?>
								<i class="fa-angle-down"></i>
							</span>
						</a>
						
						<ul class="dropdown-menu user-profile-menu list-unstyled">
<!-- 							<li>
								<a href="#edit-profile">
									<i class="fa-edit"></i>
									新的岗位
								</a>
							</li> -->
							<li>
								<a href="#settings">
									<i class="fa-wrench"></i>
									设置
								</a>
							</li>
							<li>
								<a href="#profile">
									<i class="fa-user"></i>
									资料
								</a>
							</li>
							<li>
								<a href="#help">
									<i class="fa-info"></i>
									帮助
								</a>
							</li>
							<li class="last">
								<a href="<?php echo url('Login/quit'); ?>">
									<i class="fa-lock"></i>
									注销
								</a>
							</li>
						</ul>
					</li>
					
<!-- 					<li>
						<a href="#" data-toggle="chat">
							<i class="fa-comments-o"></i>
						</a>
					</li> -->
					
				</ul>
				
			</nav>
			<script>
			jQuery(document).ready(function($)
			{
				$('a[href="#layout-variants"]').on('click', function(ev)
				{
					ev.preventDefault();
					
					var win = {top: $(window).scrollTop(), toTop: $("#layout-variants").offset().top - 15};
					
					TweenLite.to(win, .3, {top: win.toTop, roundProps: ["top"], ease: Sine.easeInOut, onUpdate: function()
						{
							$(window).scrollTop(win.top);
						}
					});
				});
			});
			</script>
 
	

	<!-- main -->
			<div class="jumbotron">

				<h1>欢迎使用</h1>
				
				<p>
					支付管理系统beta版
				</p>
				
			</div>
	<!-- main -->	

			

			<!-- Main Footer -->

			<!-- Choose between footer styles: "footer-type-1" or "footer-type-2" -->
			<!-- Add class "sticky" to  always stick the footer to the end of page (if page contents is small) -->
			<!-- Or class "fixed" to  always fix the footer to the end of page -->
			<footer class="main-footer sticky footer-type-1" >
				
				<div class="footer-inner">
				
					<!-- Add your copyright text here -->
					<div class="footer-text">
						&copy; 2014 
						<strong>Xenon</strong> 
						More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a>
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
	
	



	<!-- Bottom Scripts -->
	<script src="__STATIC__/js/bootstrap.min.js"></script>
	<script src="__STATIC__/js/TweenMax.min.js"></script>
	<script src="__STATIC__/js/resizeable.js"></script>
	<script src="__STATIC__/js/joinable.js"></script>
	<script src="__STATIC__/js/xenon-api.js"></script>
	<script src="__STATIC__/js/xenon-toggles.js"></script>


	<!-- JavaScripts initializations and stuff -->
	<script src="__STATIC__/js/xenon-custom.js"></script>

</body>
</html>