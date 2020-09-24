<?php /*a:5:{s:68:"G:\phpstudy_pro\WWW\tp5rbac\application\admin\view\article\edit.html";i:1596786388;s:66:"G:\phpstudy_pro\WWW\tp5rbac\application\admin\view\public\top.html";i:1564537202;s:69:"G:\phpstudy_pro\WWW\tp5rbac\application\admin\view\public\header.html";i:1564563722;s:67:"G:\phpstudy_pro\WWW\tp5rbac\application\admin\view\public\menu.html";i:1565232038;s:65:"G:\phpstudy_pro\WWW\tp5rbac\application\admin\view\public\js.html";i:1596693423;}*/ ?>
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

			<!--gallery css-->
			<link rel="stylesheet" href="/../static/plugins/gallery/main.css">

			<!--Morris css-->
			<link rel="stylesheet" href="/../static/plugins/morris/morris.css">
			<!--Select2 css-->
			<link rel="stylesheet" href="/../static/plugins/select2/select2.css">
			<!--Bootstrap-wysihtml5 css-->
			<link rel="stylesheet" href="/../static/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

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
                            <li class="breadcrumb-item"><a href="<?php echo url('article/index'); ?>">文章列表</a></li>
                            <li class="breadcrumb-item active" aria-current="page">添加文章</li>
                        </ol>

						<div class="row">
							<div class="col-lg-12 col-xl-2 col-md-12 col-sm-12"></div>
							<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
								<div class="card ">
									<div class="card-header">
										<h4>添加文章</h4>
									</div>
									<div class="card-body cards">
										<form id="form" class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="return false">
											<div class="form-group row">
												<label class="col-md-2 col-form-label" for="title">文章标题<span style="color:rgb(255,182,193); font-size: 20px;"> *</span></label>
												<div class="col-md-6">
													<input type="text" class="form-control" placeholder="标题" id="title" name="title" value="<?php echo htmlentities($list['title']); ?>" >
													
												</div>
												<div  class="col-md-4" id="title_down" style="float: left;color: red;display: none;margin-top: 10px;"></div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 col-form-label" for="cate_id">文章分类<span style="color:rgb(255,182,193); font-size: 20px;"> *</span></label>
												
												<div class="form-group overflow-hidden col-md-6">
													<select class="form-control select2 w-100" id="cate_id" name="cate_id">
														<?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
														<option value="<?php echo htmlentities($vo['id']); ?>" <?php if($list['cate_id'] == $vo['id']): ?> selected="selected" <?php endif; ?> ><?php echo htmlentities($vo['name']); ?></option>
														<?php endforeach; endif; else: echo "" ;endif; ?>
													</select>
												
												</div>
												<div  class="col-md-4" id="cate_down" style="float: left;color: red;display: none;margin-top: 10px;"></div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 col-form-label" >缩略图<span style="color:rgb(255,182,193); font-size: 20px;"> *</span></label>
												<div class="col-md-4 files color">
													<input type="file" id="pic" name="pic" class="form-control1" onchange="showImg(this)" accept="image/*">
												</div>
												<div class="galleryItem col-md-4" style="float: left;" >
													<img src="/../uploads/<?php echo htmlentities($list['pic']); ?>" class="card-img-top" id="displayImg" >
												</div>
												<img src="" id="displayImg" style="float: left;width: 30%;display: none;" >
												<div  class="col-md-4" id="pic_down" style="float: left;color: red;display: none;margin-top: 10px;"></div>
											</div>
											
											<div class="form-group  row">
												<label class="col-md-2 col-form-label" for="elm1">文章内容<span style="color:rgb(255,182,193); font-size: 20px;"> *</span></label>
												<div class="col-md-10">
													<textarea id="elm1" name="content"><?php echo htmlentities($list['content']); ?></textarea>
												</div>
												<div  class="col-md-4" id="content_down" style="float: left;color: red;display: none;margin-top: 10px;"></div>
											</div>

											<div class="form-group row">
												<label class="col-md-2 col-form-label" for="type">文章类型<span style="color:rgb(255,182,193); font-size: 20px;"> *</span></label>
												
												<div class="form-group overflow-hidden col-md-6">
													<select class="form-control select2 w-100" name="type" id="type">
														<option value="1" <?php if($list['type'] == '原创'): ?> selected="selected" <?php endif; ?>>原创</option>
														<option value="2" <?php if($list['type'] == '转载'): ?> selected="selected" <?php endif; ?>>转载</option>
														<option value="3" <?php if($list['type'] == '翻译'): ?> selected="selected" <?php endif; ?>>翻译</option>
													</select>
												</div>
												<div  class="col-md-4" id="type_down" style="float: left;color: red;display: none;margin-top: 10px;"></div>
											</div>

											<div class="form-group mb-0 mt-2 row justify-content-end">
												<div class="col-md-12 text-center">
													<button id="btn" type="submit" class="btn btn-primary">提 交</button>
													<a href="<?php echo url('article/index'); ?>" class="btn btn-outline-info">返 回</a> 
												</div>
											</div>
											
										</form>
										
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
	<!--gallery js-->
	<script src="/../static/plugins/gallery/main.js"></script>
	<!--ckeditor js-->
	<script src="/../static/plugins/tinymce/tinymce.min.js"></script>
	<!--Scripts js-->
<script src="/../static/js/scripts.js"></script>
	<script src="/../static/js/formeditor.js"></script>
	<script type="text/javascript">
	
		function showImg(obj){
			var file=obj.files[0];
			var reader =new FileReader();
			reader.onload=function (e){
				$('#displayImg').show();
				var img=document.getElementById('displayImg');
				img.src=e.target.result;
			}
			reader.readAsDataURL(file);
		}
		  
		$("#form").submit(function(){
			// var formData = new FormData($('#form')[2]);
			var title=$('#title').val().trim();
			var cate_id=$('#cate_id').val().trim();
			var pic=$('#pic').val();  
			var content=$('#elm1').val(); 
			var type=$('#type').val().trim();
			if(title==""){
				$('#title_down').show();
		  		$('#title_down').text('文章标题必须填写');
				$('#title').focus();
				return false;
			}else{
				$('#title_down').hide();
			}
			if(cate_id==""){
				$('#cate_down').show();
		  		$('#cate_down').text('选择文章分类');
				$('#cate_id').focus();
				return false;
			}else{
				$('#cate_down').hide();
			}
			if(pic==""){
				$('#pic_down').show();
		  		$('#pic_down').text('缩略图必须上传');
				$('#pic').focus();
				return false;
			}else{
				$('#pic_down').hide();
			}
			if(content==""){
				$('#content_down').show();
		  		$('#content_down').text('文章内容必须填写');
				$('#elm1').focus();
				return false;
			}else{
				$('#content_down').hide();
			}
			if(type==""){
				$('#type_down').show();
		  		$('#type_down').text('选择文章类型');
				$('#type').focus();
				return false;
			}else{
				$('#type_down').hide();
			}
			var form  =document.getElementById('form'),
            formData =  new FormData(form);
			$.ajax({
				type:'post',
				url:"<?php echo url('/admin/article/edit'); ?>",
				data:formData,
				dataType:'json',
				contentType: false,
            	processData: false,
				success:function(msg){
					if(msg.status==1){
						toastr.success('', msg.msg);
						// $(".cards").load(location.href+" .cards");
						setTimeout("location.reload()",1000);//设置延迟时间执行
						// window.location.href="index";

					}else{
						toastr.error('', msg.msg);
					}
				},
				error:function(msg){
					toastr.error('请联系管理员', '系统错误');
					
				}
			})
			
		});
	</script>
</block>
</body>
</html>