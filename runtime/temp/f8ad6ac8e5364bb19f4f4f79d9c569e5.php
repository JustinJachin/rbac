<?php /*a:5:{s:67:"G:\phpstudy_pro\WWW\tp5rbac\application\index\view\index\index.html";i:1597987388;s:66:"G:\phpstudy_pro\WWW\tp5rbac\application\index\view\public\top.html";i:1597990010;s:69:"G:\phpstudy_pro\WWW\tp5rbac\application\index\view\public\header.html";i:1597988917;s:67:"G:\phpstudy_pro\WWW\tp5rbac\application\index\view\public\menu.html";i:1597987328;s:65:"G:\phpstudy_pro\WWW\tp5rbac\application\index\view\public\js.html";i:1596693423;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo htmlentities((isset($title) && ($title !== '')?$title:'博客')); ?></title>

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
		<!--morris css-->
		<link rel="stylesheet" href="/../static/plugins/morris/morris.css">

		
	</block>
</head>

<body class="app ">

<div id="spinner"></div>

<div id="app">
	<div class="main-wrapper" >
		<nav class="navbar navbar-expand-lg main-navbar col-12">
    <a class="header-brand" href="index.html" style="margin-left: 10%">
        <!-- 可替换 -->
        <img src="/../static/img/brand/logo.png" class="header-brand-img" alt="Kharna-Admin  logo">
    </a>
    <ul class="nav nav-pills " id="myTab3" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true">首页</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false">文章</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false">视频</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false">图片</a>
        </li>
    </ul>
    <form class="form-inline mr-auto">
        
        <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-primary" type="submit"><i class="ion ion-search"></i></button>
        </div>
    </form>
    <ul class="navbar-nav navbar-right" style="margin-right: 10%">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link  nav-link-lg">
            登录
            </a>
        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link  nav-link-lg">
            注册
            </a>
        </li>
        <!-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="ion-ios-email-outline"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Messages
                    <div class="float-right">
                        <a href="#">View All</a>
                    </div>
                </div>
                <div class="dropdown-list-content">
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <img alt="image" src="assets/img/avatar/avatar-1.jpeg.jpg" class="rounded-circle dropdown-item-img">
                        <div class="dropdown-item-desc">
                            <div class="dropdownmsg d-flex">
                                <div class="">
                                    <b>Stewart Ball</b>
                                    <p>Your template awesome</p>
                                </div>
                                <div class="time">6 hours ago</div>
                            </div>

                        </div>
                    </a>
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <img alt="image" src="assets/img/avatar/avatar-2.jpeg.jpg" class="rounded-circle dropdown-item-img">
                        <div class="dropdown-item-desc">
                            <div class="dropdownmsg d-flex">
                                <div class="">
                                    <b>Jonathan North</b>
                                    <p>Your Order Shipped.....</p>
                                </div>
                                <div class="time">45 mins ago</div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <img alt="image" src="assets/img/avatar/avatar-4.jpeg.jpg" class="rounded-circle dropdown-item-img">
                        <div class="dropdown-item-desc">
                            <div class="dropdownmsg d-flex">
                                <div class="">
                                    <b>Victor Taylor</b>
                                    <p>Hi!, I' am web developer</p>
                                </div>
                                <div class="time"> 8 hours ago</div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <img alt="image" src="assets/img/avatar/avatar-3.jpeg.jpg" class="rounded-circle dropdown-item-img">
                        <div class="dropdown-item-desc">
                            <div class="dropdownmsg d-flex">
                                <div class="">
                                    <b>Ruth Arnold</b>
                                    <p>Hi!, I' am web designer</p>
                                </div>
                                <div class="time"> 3 hours ago</div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <img alt="image" src="assets/img/avatar/avatar-5.jpeg.jpg" class="rounded-circle dropdown-item-img">
                        <div class="dropdown-item-desc">
                            <div class="dropdownmsg d-flex">
                                <div class="">
                                    <b>Sam  Lyman</b>
                                    <p>Hi!, I' am java developer</p>
                                </div>
                                <div class="time"> 15 mintues ago</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </li>
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link  nav-link-lg beep"><i class="ion-ios-bell-outline"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifications
                    <div class="float-right">
                        <a href="#">View All</a>
                    </div>
                </div>
                <div class="dropdown-list-content">
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-users text-primary"></i>
                        <div class="dropdown-item-desc">
                            <b>So many Users Visit your template</b>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-exclamation-triangle text-danger"></i>
                        <div class="dropdown-item-desc">
                            <b>Error message occurred....</b>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-users text-warning"></i>
                        <div class="dropdown-item-desc">
                            <b> Adding new people</b>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-shopping-cart text-success"></i>
                        <div class="dropdown-item-desc">
                            <b>Your items Arrived</b>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-comment text-primary"></i>
                        <div class="dropdown-item-desc">
                            <b>New Message received</b> <div class="float-right"><span class="badge badge-pill badge-danger badge-sm">67</span></div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-users text-primary"></i>
                        <div class="dropdown-item-desc">
                            <b>So many Users Visit your template</b>
                        </div>
                    </a>
                </div>
            </div>
        </li>

        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
                <img src="assets/img/avatar/avatar-1.jpeg.jpg" alt="profile-user" class="rounded-circle w-32">
                <div class="d-sm-none d-lg-inline-block">Jessica Lee</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="profile.html" class="dropdown-item has-icon">
                    <i class="ion ion-android-person"></i> Profile
                </a>
                <a href="profile.html" class="dropdown-item has-icon">
                    <i class="ion-android-drafts"></i> Messages
                </a>
                <a href="profile.html" class="dropdown-item has-icon">
                    <i class="ion ion-gear-a"></i> Settings
                </a>
                <a href="#" class="dropdown-item has-icon">
                    <i class="ion-ios-redo"></i> Logout
                </a>
            </div>
        </li>  -->
    </ul>
</nav>
		<!-- <aside class="app-sidebar">
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
    
</aside> -->
		<block name="bodsy">
			<div class="app-content">
				<section class="section">
					
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

<!--Dashboard js-->
<script src="/../static/js/dashboard.js"></script>
<script src="/../static/js/apexcharts.js"></script>



</block>
</body>


</html>








