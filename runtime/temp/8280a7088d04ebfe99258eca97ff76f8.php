<?php /*a:5:{s:74:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\mail\index.html";i:1568948438;s:74:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\public\top.html";i:1564537202;s:77:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\public\header.html";i:1564563722;s:75:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\public\menu.html";i:1565232038;s:73:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\public\js.html";i:1565071540;}*/ ?>
<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title><?php echo htmlentities((isset($title) && ($title !== '')?$title:'后台管理系统')); ?></title>

<!--Favicon -->
<link rel="icon" href="/../static/img/favicon.ico" type="image/x-icon"/>

<!--Bootstrap.min css-->
<link rel="stylesheet" href="/../static/plugins/bootstrap/css/bootstrap.min.css">

<!--Icons css-->
<link rel="stylesheet" href="/../static/css/icons.css">

<!--Style css-->
<link rel="stylesheet" href="/../static/css/style.css">

<!--mCustomScrollbar css-->
<link rel="stylesheet" href="/../static/plugins/scroll-bar/jquery.mCustomScrollbar.css">

<!--Sidemenu css-->
<link rel="stylesheet" href="/../static/plugins/toggle-menu/sidemenu.css">

<!--Chartist css-->
<link rel="stylesheet" href="/../static/plugins/chartist/chartist.css">
<link rel="stylesheet" href="/../static/plugins/chartist/chartist-plugin-tooltip.css">

<!--Full calendar css-->
<link rel="stylesheet" href="/../static/plugins/fullcalendar/stylesheet1.css">

<!--Toastr css-->
<link rel="stylesheet" href="/../static/plugins/toastr/build/toastr.css">
<link rel="stylesheet" href="/../static/plugins/toaster/garessi-notif.css">



<!--&lt;!&ndash;morris css&ndash;&gt;-->
<!--<link rel="stylesheet" href="/../static/plugins/morris/morris.css">-->
			<block name="topCss">
				<!--DataTables css-->
				<link rel="stylesheet" href="/../static/plugins/Datatable/css/dataTables.bootstrap4.css">

				<!--iCheck css-->
				<link rel="stylesheet" href="/../static/plugins/iCheck/all.css">
				<!--Morris css-->
				<link rel="stylesheet" href="/../static/plugins/morris/morris.css">
				<!--Select2 css-->
				<link rel="stylesheet" href="/../static/plugins/select2/select2.css">

			</block>
		</head>

		<body class="app ">

			<div id="spinner"></div>

			<div id="app">
				<div class="main-wrapper" >
					<nav class="navbar navbar-expand-lg main-navbar">
    <a class="header-brand" href="index.html">
        <img src="/../static/img/brand/logo.png" class="header-brand-img" alt="Kharna-Admin  logo">
    </a>
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="ion ion-navicon-round"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch"><i class="ion ion-search"></i></a></li>
        </ul>
        
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
                <img src="/../static/img/avatar/avatar-1.jpeg.jpg" alt="profile-user" class="rounded-circle w-32">
                <div class="d-sm-none d-lg-inline-block"><?php echo htmlentities(app('session')->get('admin_name')); ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="<?php echo url('admin/edit'); ?>" class="dropdown-item has-icon">
                    <i class="ion ion-android-person"></i> 个人中心
                </a>
                <a href="<?php echo url('login/logout'); ?>" class="dropdown-item has-icon">
                    <i class="ion-ios-redo"></i> 退出登录
                </a>
            </div>
        </li>
    </ul>
</nav>
					<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <div class="dropdown">
            <a class="nav-link pl-2 pr-2 leading-none d-flex" data-toggle="dropdown" href="#">
                <img alt="image" src="/../static/img/avatar/avatar-1.jpeg.jpg" class=" avatar-md rounded-circle">
                <span class="ml-2 d-lg-block">
                    <span class="text-white app-sidebar__user-name mt-5"><?php echo htmlentities(app('session')->get('admin_name')); ?></span><br>
                    <span class="text-muted app-sidebar__user-name text-sm"> Web-Designer</span>
                </span>
            </a>
        </div>
    </div>
    <ul class="side-menu">
        <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;if($menu['star'] == true): ?>
        <li class="slide active">
            <a class="side-menu__item active"  data-toggle="slide" href="<?php echo url($menu['name']); ?>">
                <i class="side-menu__icon fa <?php echo htmlentities($menu['icons']['name']); ?>"></i> 
                <span class="side-menu__label"><?php echo htmlentities($menu['title']); ?></span>
                <?php if($menu['children'] != '1'): ?>
                <i class="angle fa fa-angle-right"></i>
                <?php endif; ?>
            </a>
            <ul class="slide-menu">
                <?php if(is_array($menu['children']) || $menu['children'] instanceof \think\Collection || $menu['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $menu['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$children): $mod = ($i % 2 );++$i;if($children['star'] == true): ?>
                <li class="active"><a class="slide-item"  href="<?php echo url($children['name']); ?>"><span><?php echo htmlentities($children['title']); ?></span></a></li>
                <?php else: ?>
                <li><a class="slide-item"  href="<?php echo url($children['name']); ?>"><span><?php echo htmlentities($children['title']); ?></span></a></li>
                <?php endif; ?>
                <?php endforeach; endif; else: echo "" ;endif; ?>
               
            </ul>
        </li>
        <?php else: ?>
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="<?php echo url($menu['name']); ?>">
                <i class="side-menu__icon fa <?php echo htmlentities($menu['icons']['name']); ?>"></i> 
                <span class="side-menu__label"><?php echo htmlentities($menu['title']); ?></span>
                <?php if($menu['children'] != '1'): ?>
                <i class="angle fa fa-angle-right"></i>
                <?php endif; ?>
            </a>
            <ul class="slide-menu">
                <?php if(is_array($menu['children']) || $menu['children'] instanceof \think\Collection || $menu['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $menu['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$children): $mod = ($i % 2 );++$i;?>
                <li><a class="slide-item"  href="<?php echo url($children['name']); ?>"><span><?php echo htmlentities($children['title']); ?></span></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</aside>
					<block name="bodsy">
						<div class="app-content">
							<section class="section">
								<ol class="breadcrumb">
							        <li class="breadcrumb-item"><a href="<?php echo url('index/index'); ?>">首页</a></li>
							        <li class="breadcrumb-item active" aria-current="page">邮件发送</li>
							    </ol>

								<div class="row">
									<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12"></div>
									<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
										<div class="card">
											<div class="card-header">
												<h4>邮件发送测试</h4>
											</div>
											<div class="card-body">
												<form class="form-horizontal" id="form" method="post" enctype="multipart/form-data"  target="addfile">
													<div class="form-group row">
														<label for="sjr" class="col-md-3 col-form-label">发送邮箱</label>
														<div class="col-md-9">
															<input type="text" class="form-control" id="sjr" placeholder="sjr">
														</div>
													</div>
													<div class="form-group row">
														<label for="title" class="col-md-3 col-form-label">发送标题</label>
														<div class="col-md-9">
															<input type="text" class="form-control" id="title" placeholder="title">
														</div>
													</div>
													<div class="form-group row">
														<label for="content" class="col-md-3 col-form-label">发送内容</label>
														<div class="col-md-9">
															<input type="text" class="form-control" id="content" placeholder="content">
														</div>
													</div>
													<div class="form-group mb-0 mt-2 row justify-content-end">
														<div class="col-md-9">
															<button type="button" onclick="sendMessage()" class="btn btn-primary">提 交</button>
															<a href="<?php echo url('admin/index'); ?>" class="btn btn-outline-info">返 回</a> 
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12"></div>
								</div>

							</section>
						</div>
						
					</block>
				</div>
			</div>
			<!--Jquery.min js-->
<script src="/../static/js/jquery.min.js"></script>

<!--popper js-->
<script src="/../static/js/popper.js"></script>

<!--Tooltip js-->
<script src="/../static/js/tooltip.js"></script>

<!--Bootstrap.min js-->
<script src="/../static/plugins/bootstrap/js/bootstrap.min.js"></script>

<!--Jquery.nicescroll.min js-->
<script src="/../static/plugins/nicescroll/jquery.nicescroll.min.js"></script>

<!--Scroll-up-bar.min js-->
<script src="/../static/plugins/scroll-up-bar/dist/scroll-up-bar.min.js"></script>

<!--Sidemenu js-->
<script src="/../static/plugins/toggle-menu/sidemenu.js"></script>

<!--mCustomScrollbar js-->
<script src="/../static/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

<!-- ECharts -->
<script src="/../static/plugins/echarts/dist/echarts.js"></script>

<!--Min Calendar -->
<script src="/../static/plugins/fullcalendar/calendar.min.js"></script>
<script src="/../static/plugins/fullcalendar/custom_calendar.js"></script>

<!--Morris js-->
<script src="/../static/plugins/morris/morris.min.js"></script>
<script src="/../static/plugins/morris/raphael.min.js"></script>

<!--Scripts js-->
<script src="/../static/js/scripts.js"></script>

<!--Toastr js-->
<script src="/../static/plugins/toastr/build/toastr.min.js"></script>
<script src="/../static/plugins/toaster/garessi-notif.js"></script>
<!--公用函数 js-->	
<script src="/../static/js/commont.js"></script>
			<block name="js">

				<script>
					
					function sendMessage(){
						var sjr=$('#sjr').val();
						var title=$('#title').val();
						var content=$('#content').val();
						$.ajax({
							type:'post',
							url:"<?php echo url('/admin/Mail/index'); ?>",
							data:{'sjr':sjr,'title':title,'content':content},
							dataType:'json',
							success:function(data){
								if(data.status==1){
									toastr.success('',data.msg);
								}else{
									toastr.error('',data.msg);
								}
							},
							error:function(msg){
								toastr.error('请联系管理员','系统错误');
							}
						})
					}
				   
				    
				</script>
				<!--DataTables css-->
				<script src="/../static/plugins/Datatable/js/jquery.dataTables.js"></script>
				<script src="/../static/plugins/Datatable/js/dataTables.bootstrap4.js"></script>
				<!--iCheck js-->
				<script src="/../static/plugins/iCheck/icheck.min.js"></script>
			</block>
		</body>
	</html>