<?php /*a:5:{s:74:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\role\store.html";i:1565318393;s:74:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\public\top.html";i:1564537202;s:77:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\public\header.html";i:1564563722;s:75:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\public\menu.html";i:1565232038;s:73:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\public\js.html";i:1565071540;}*/ ?>
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
		<!--iCheck css-->
		<link rel="stylesheet" href="/../static/plugins/iCheck/all.css">
		</block>
		<style type="text/css">
			.listul,.listul li{
				list-style-type: none;
			}
			.listul li{
				float: left;
			}
		</style>
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
                            <li class="breadcrumb-item"><a href="<?php echo url('role/index'); ?>">角色页面</a></li>
                            <li class="breadcrumb-item active" aria-current="page">权限分配</li>
					    </ol>
						
						<div class="row">
							<div class="col-lg-12 col-xl-2 col-md-12 col-sm-12"></div>
							<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
								<div class="card ">
									<div class="card-header">
										<h4>后台权限分配</h4>
									</div>
									<div class="card-body cards">
										<form id="form" class="form-horizontal" onsubmit="return false"  method="post" enctype="multipart/form-data"  target="addfile">
											<input type="hidden" name="id" value="<?php echo htmlentities($id); ?>" id="id">
											<div class="form-group row">
												<ul id="demo" class="listul">
													<?php if(is_array($access) || $access instanceof \think\Collection || $access instanceof \think\Paginator): $i = 0; $__LIST__ = $access;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
													<li class="col-md-12" style="font-size: 40px;">
														<?php if($vo['flag'] == 1): ?>
														<input  type="checkbox" name="choice" value="<?php echo htmlentities($vo['id']); ?>" id="<?php echo htmlentities($vo['id']); ?>" checked />
														<label for="<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['title']); ?></label>
														<?php else: ?>
														<input  type="checkbox" name="choice" value="<?php echo htmlentities($vo['id']); ?>" id="<?php echo htmlentities($vo['id']); ?>" />
														<label for="<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['title']); ?></label>
														<?php endif; if($vo['children'] != ''): ?>
														<ul  class="col-md-12">
															<?php if(is_array($vo['children']) || $vo['children'] instanceof \think\Collection || $vo['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cvo): $mod = ($i % 2 );++$i;?>
															<li class="col-md-12" style="font-size: 18px;">
																<?php if($cvo['flag'] == 1): ?>
																<input  type="checkbox" name="choice" value="<?php echo htmlentities($cvo['id']); ?>" id="<?php echo htmlentities($cvo['id']); ?>" checked />
																<label for="<?php echo htmlentities($cvo['id']); ?>"><?php echo htmlentities($cvo['title']); ?></label>
																<?php else: ?>
																<input  type="checkbox" name="choice" value="<?php echo htmlentities($cvo['id']); ?>" id="<?php echo htmlentities($cvo['id']); ?>" />
																<label for="<?php echo htmlentities($cvo['id']); ?>"><?php echo htmlentities($cvo['title']); ?></label>
																<?php endif; if($cvo['children'] != ''): ?>
																<ul  class="col-md-12"> 
																	<?php if(is_array($cvo['children']) || $cvo['children'] instanceof \think\Collection || $cvo['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $cvo['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ccvo): $mod = ($i % 2 );++$i;?>
																	<li  class="col-md-2" style="float: left;">
																		<?php if($ccvo['flag'] == 1): ?>
																		<input  type="checkbox" name="choice" value="<?php echo htmlentities($ccvo['id']); ?>" id="<?php echo htmlentities($ccvo['id']); ?>" checked />
																		<label for="<?php echo htmlentities($ccvo['id']); ?>"><?php echo htmlentities($ccvo['title']); ?></label>
																		<?php else: ?>
																		<input  type="checkbox" name="choice" value="<?php echo htmlentities($ccvo['id']); ?>" id="<?php echo htmlentities($ccvo['id']); ?>" />
																		<label for="<?php echo htmlentities($ccvo['id']); ?>"><?php echo htmlentities($ccvo['title']); ?></label>
																		 <?php endif; ?>
																	</li>
																	<?php endforeach; endif; else: echo "" ;endif; ?>
																</ul>
																<?php endif; ?>
															</li>
															<?php endforeach; endif; else: echo "" ;endif; ?>
															
														</ul>
														<?php endif; ?>
													</li>
													<?php endforeach; endif; else: echo "" ;endif; ?>
												</ul>
												
											</div>
											<div class="form-group mb-0 mt-2 row justify-content-end ">
												<div class="col-md-12 text-center">
													<button type="submit" class="btn btn-primary">提 交</button>
													<a href="<?php echo url('role/index'); ?>" class="btn btn-outline-info">返 回</a> 
												</div>
											</div>
										</form>
										<iframe id="addfile_iframe" src="" name="addfile" style="display: none;" frameborder="0"></iframe>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-xl-2 col-md-12 col-sm-12"></div>
							
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
				window.onload = function(){ 
			        var obj = document.getElementById('demo').getElementsByTagName('input'); 
			        for(var i = 0; i < obj.length; i ++) { 
			            obj[i].onclick = function() { //查找并选择/取消选择所有子项 
			            	var childrenObj = this.parentNode.getElementsByTagName('ul');
			               	if (childrenObj.length > 0){ 
			                	for (var j = 0;j < childrenObj.length; j ++){ 
			                  		var o = childrenObj[j].getElementsByTagName('input'); 
			                  		for (var k = 0; k < o.length; k ++)
			                  			o[k].checked = this.checked; 
			                  	} 
			                } //递归方法检查并设置父选项选择状态 
			                checkParent(this); 
			            } 
			        } 
			    } 
			    function checkParent(obj) { 
			        var parentObj = obj.parentNode.parentNode; 
			        if (parentObj.id != 'demo'){ 
			        	parentObj = parentObj.parentNode; var FLAG = false; // true表示父级选项的所有子选项存在选中的，初始值为false，假设全部未选中 
			            var o = parentObj.getElementsByTagName('input'); 
			            for (var i = 1; i < o.length; i ++) { 
			            	if (o[i].checked) { FLAG = true; break; 
			            }
			        }
			        if (FLAG) o[0].checked = true;
			        else o[0].checked = false; 
			        if (parentObj.parentNode.parentNode.id != 'demo') 
			        	checkParent(o[0]); 
			        } 
			    } 
				
				$("#form").submit(function(){
					var id = document.getElementById("id").value;//找到元素，假如给input元素加了id属性 且 值为:text
					// var text = inputDom.value; 
					var t = $('#form').serializeArray(); // 默认是json 格式               

					//传统的for循环,将值打印出来    
					var d=[];
					for (var i = 1;i<t.length;i++) {
						d[i-1] = t[i].value;
					}
					var str=d.join();
					$.ajax({
						type:'post',
						url:"<?php echo url('/admin/role/store'); ?>",
						data:{'data':str,'id':id},
						dataType:'json',
						success:function(data){
							if(data.status==1){
								toastr.success('', data.msg);
								// $(".cards").load(location.href+".cards");
								setTimeout("window.history.back(-1)",1000);//设置延迟时间执行
							}else{
								toastr.error('', data.msg);
							}
						},
						error:function(msg){
							
							toastr.error('请联系管理员', '系统错误');
							
						}
					})
				
				});

			</script>
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