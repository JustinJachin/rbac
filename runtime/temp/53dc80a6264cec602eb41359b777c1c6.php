<?php /*a:5:{s:80:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\permission\index.html";i:1564109649;s:74:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\public\top.html";i:1564109934;s:77:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\public\header.html";i:1563327285;s:75:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\public\menu.html";i:1563954144;s:73:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\public\js.html";i:1564107508;}*/ ?>
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





<!--&lt;!&ndash;morris css&ndash;&gt;-->
<!--<link rel="stylesheet" href="/../static/plugins/morris/morris.css">-->
			<block name="topCss">
				<!--DataTables css-->
				<link rel="stylesheet" href="/../static/plugins/Datatable/css/dataTables.bootstrap4.css">

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
        <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-primary" type="submit"><i class="ion ion-search"></i></button>
        </div>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
                <img src="/../static/img/avatar/avatar-1.jpeg.jpg" alt="profile-user" class="rounded-circle w-32">
                <div class="d-sm-none d-lg-inline-block"><?php echo htmlentities(app('session')->get('admin_name')); ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="profile.html" class="dropdown-item has-icon">
                    <i class="ion ion-android-person"></i> Profile
                </a>
                <a href="<?php echo url('login/logout'); ?>" class="dropdown-item has-icon">
                    <i class="ion-ios-redo"></i> Logout
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
                <i class="<?php echo htmlentities($menu['icon']); ?>"></i>
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
                <i class="<?php echo htmlentities($menu['icon']); ?>"></i>
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
							        <li class="breadcrumb-item active" aria-current="page">权限页面</li>
							    </ol>

								<div class="row">
									<div class="col-lg-12">
										<div class="card">
											<div class="card-header">
												<h4>权限列表</h4>
											</div>
											<div class="card-body">
												<a href="#" class="btn btn-primary">add</a>
												<div class="table-responsive">
													<table id="example" class="table table-striped table-bordered border-t0 text-nowrap w-100" >
														<thead>
															<tr>
																<th class="row-selected">
																	<input class="minimal" type="checkbox"  onclick="selectAll(this)" id="checkall">
																	<label for="checkall">全选</label>
																</th>
																<th class="wd-15p">ID</th>
																<th class="wd-15p">描述</th>
																<th class="wd-15p">名字</th>
																<th class="wd-20p">模型</th>
																<th class="wd-15p">图标</th>
															
																<th class="wd-10p">是否是导航栏</th>
																<th class="wd-25p">上级描述</th>
																<th class="wd-25p">创建时间</th>
																<th class="wd-25p">更新时间</th>
																<th class="wd-25p">操作</th>
															</tr>
														</thead>
														<tbody>
															<?php if(is_array($permission) || $permission instanceof \think\Collection || $permission instanceof \think\Paginator): $i = 0; $__LIST__ = $permission;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
															<tr>
																<td>
																	<input type="checkbox" class="minimal" name="choice" value="<?php echo htmlentities($vo['id']); ?>">
																</td>
																<td><?php echo htmlentities($vo['id']); ?></td>
																<td><?php echo htmlentities($vo['title']); ?></td>
																<td><?php echo htmlentities($vo['name']); ?></td>
																<td><?php echo htmlentities($vo['model']); ?></td>
																<td><i class="<?php echo htmlentities($vo['icon']); ?>"></i></td>
																
																<td><?php echo htmlentities($vo['display_menu']); ?></td>
																<td>
																	<?php echo htmlentities($vo['parentName']); ?>
																</td>
																<td><?php echo htmlentities($vo['create_time']); ?></td>
																<td><?php echo htmlentities($vo['update_time']); ?></td>
																<td>
																	<div class="btn-group align-top">
																		<button class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-toggle="modal" type="button">Edit</button>
																	</div>
																	<div class="btn-group align-top">
																		<button class="btn btn-sm btn-danger badge" type="button"><i class="fa fa-trash"></i></button>
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
						<!-- <script>
							$(function(e) {
								$('#example').DataTable();
							} );
						</script> -->
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


			<block name="js">
				<script>
				// 	document.getElementById("check").onclick = function(){
    //     var checked = document.getElementById("check").checked;
    //     var checkson = document.getElementsByName("id[]");
    //     if(checked){
    //         for(var i = 0; i < checkson.length ;i++){
    //             checkson[i].checked = true;
    //         }
    //     }else{
    //         for(var i = 0; i < checkson.length ;i++){
    //             checkson[i].checked = false;
    //         }
    //     }
    // }
			    function selectAll(choiceBtn){   
			        //document.getElementsByTagName()
				    var arr=document.getElementsByName("choice");
				    for(var i=0;i<arr.length;i++){
				        arr[i].checked=choiceBtn.checked;//循环遍历看是否全选
				    }
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