<?php /*a:5:{s:68:"G:\phpstudy_pro\WWW\tp5rbac\application\admin\view\article\cate.html";i:1596677189;s:66:"G:\phpstudy_pro\WWW\tp5rbac\application\admin\view\public\top.html";i:1564537202;s:69:"G:\phpstudy_pro\WWW\tp5rbac\application\admin\view\public\header.html";i:1564563722;s:67:"G:\phpstudy_pro\WWW\tp5rbac\application\admin\view\public\menu.html";i:1565232038;s:65:"G:\phpstudy_pro\WWW\tp5rbac\application\admin\view\public\js.html";i:1596693423;}*/ ?>
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
			<!-- <link type="text/css" rel="stylesheet" href="test/jeDate-test.css"> -->
    		<link type="text/css" rel="stylesheet" href="/../static/dateTime/skin/jedate.css">
    		<script type="text/javascript" src="/../static/dateTime/src/jedate.js"></script>
			<!--iCheck css-->
			<link rel="stylesheet" href="/../static/plugins/iCheck/all.css">

			
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
						        <li class="breadcrumb-item active" aria-current="page">分类页面</li>
						    </ol>

							<div class="row">
								<div class="col-lg-12">
									<div class="card">
										<div class="card-header">
											<form class="float-right" method="get">
												<div class="input-group">
													<label class="col-md-2" for="start">创建时间:</label>
													<input type="text" class="form-control" id="start" name="start" style="width: 260px;" placeholder="搜索时间" value="<?php echo htmlentities($start); ?>"> 
													<label class="col-md-2" for="name">分类名：</label>
													<input type="text" class="form-control" id="name" name="name" style="width: 12%;" placeholder="分类名" value="<?php echo htmlentities($name); ?>">
													
													<div class="input-group-btn">
														<button class="btn btn-primary" ><i class="ion ion-search"></i></button>
													</div>
												</div>
											</form>	
											<h4>分类列表</h4>
										</div>
										<div class=" col-lg-12" style="margin-top:20px;margin-bottom: -10px;">
											<div class="float-left" style="margin-right: 10px;">
												<a href="<?php echo url('article/cateAdd'); ?>" class="btn btn-primary" >添加分类</a> 
											</div>
											
											<div class="float-right col-lg-4">
												
											</div> 
											
										</div>
										<div class="card-body">
											<div class="table-responsive">
											<table id="example" class="table table-striped table-bordered border-t0 text-nowrap w-100" >
												<thead>
													<tr class="text-center">
														
														<th >ID</th>
														<th >分类名</th>
														<th >排序</th>
														<th >创建时间</th>
														<th >操作</th>
													</tr>
												</thead>
												<tbody>
													<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
													<tr class="text-center">
														<td><?php echo htmlentities($vo['id']); ?></td>
														<td><?php echo htmlentities($vo['name']); ?></td>
														<td><?php echo htmlentities($vo['sort']); ?></td>
														<td><?php echo htmlentities($vo['create_time']); ?></td>
														<td>
															<div class="btn-group align-top">
																<a href="<?php echo url('article/cateEdit?id='.$vo['id']); ?>" class="btn btn-sm btn-primary m-b-5 m-t-5">编辑分类</a>
															</div>
															<div class="btn-group align-top">
																<button onclick="btn(<?php echo htmlentities($vo['id']); ?>,'','cateDel')" class="btn btn-sm btn-danger m-b-5 m-t-5 ajax-get"><i class="fa fa-trash"></i></button>
															</div>
														</td>
													
													</tr>
													<?php endforeach; endif; else: echo "" ;endif; ?>
												</tbody>
											</table>
										</div>
										<div id="page" class="page">
												<?php echo $page; ?>
											</div>
										</div>
									</div>
								</div>
							</div>

						</section>
					</div>
					
				</block>
			</div>
		</div>
		<script>
			jeDate("#start",{
		        theme:{bgcolor:"#00A1CB",pnColor:"#00CCFF"},
		        multiPane:false,
		        range:" ~ ",
		        format: "YYYY-MM-DD hh:mm:ss"
		    });
			function selectAll(choiceBtn){
			    var arr=document.getElementsByName("choice");
			    for(var i=0;i<arr.length;i++){
			        arr[i].checked=choiceBtn.checked;//循环遍历看是否全选
			    }
		    }
		    function btn(id,method,action){
		    	var url="<?php echo url('Article/"+action+"'); ?>";
		    	var data={'method':method,'id':id};
		    	AjaxGet(url,data);
		    }

		</script>
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
			<!--DataTables css-->
			<script src="/../static/plugins/Datatable/js/jquery.dataTables.js"></script>
			<script src="/../static/plugins/Datatable/js/dataTables.bootstrap4.js"></script>

			<!--Select2 js-->
			<script src="/../static/plugins/select2/select2.full.js"></script>

			<!--Inputmask js-->
			<script src="/../static/plugins/inputmask/jquery.inputmask.js"></script>

			<!--Moment js-->
			<script src="/../static/plugins/moment/moment.min.js"></script>

			<!--Bootstrap-daterangepicker js-->
			<script src="/../static/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

			<!--Bootstrap-datepicker js-->
			<script src="/../static/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

			<!--Bootstrap-colorpicker js-->
			<script src="/../static/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>

			<!--Bootstrap-timepicker js-->
			<script src="/../static/plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>

			<!--iCheck js-->
			<script src="/../static/plugins/iCheck/icheck.min.js"></script>

			<!--forms js-->
			<script src="/../static/js/forms.js"></script>

		</block>
	</body>
</html>