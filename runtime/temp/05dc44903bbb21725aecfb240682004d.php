<?php /*a:3:{s:75:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\login\login.html";i:1571386289;s:76:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\publics\head.html";i:1571386746;s:78:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\publics\footer.html";i:1571386715;}*/ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kharna-Admin Dashboard</title>
        <!--Favicon -->
        <link rel="icon" href="favicon.ico" type="image/x-icon"/>
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
        <!--Toastr css-->
        <link rel="stylesheet" href="/../static/plugins/toastr/build/toastr.css">
        <link rel="stylesheet" href="/../static/plugins/toaster/garessi-notif.css">
    </head>
    <body class="bg-primary">
        <div id="app">
            
                
                        
<section class="section section-2">
	<div class="container">
		<div class="row">
			<div class="single-page single-pageimage construction-bg cover-image " data-image-src="/../static/img/news/img14.jpg">
			    <div class="row">
			        <div class="col-lg-6">
			            <div class="wrapper wrapper2">
							<form id="login" class="card-body" tabindex="500" method="post" >
								<h3>LOGIN</h3>
								<div class="mail">
									<input type="" name="email">
									<label>username/email</label>
								</div>
								<div class="passwd">
									<input type="password" name="password">
									<label>password</label>
								</div>
								<div class="mail">
									<input type="text" name="code" style="width: 100px;margin-right: 200px">
			<!--                                                <img src="<?php echo captcha_src(); ?>" onclick="this.src='<?php echo captcha_src(); ?>?'+Math.random()" style="margin-left: 100px;margin-top: -60px"/>-->
			                        <img src="<?php echo url('admin/login/verify'); ?>" onclick="changeCode(this)" style="margin-left: 100px;margin-top: -60px"/>
									<label>Verification</label>
								</div>
								<div class="submit">
									<input class="btn btn-primary btn-block" value="Login" type="submit">
								</div>
								<p class="mb-2"><a href="<?php echo url('login/forget'); ?>" >Forgot Your Password?</a></p>
							</form>

						</div>
					</div>
					<div class="col-lg-6">
						<div class="log-wrapper text-center">
							<h3>Welcome</h3>
							<h3>Login background system</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
                    
            
        </div>
        <script>
            // 点击验证码刷新图片
            function changeCode(obj)
            {
                var url = "<?php echo url('login/verify',['random'=>"+Math.random+"]); ?>";  //兼容低版本的浏览器
                obj.src = url;
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

        <script src="/../static/js/moment.min.js"></script>

        <!--mCustomScrollbar js-->
        <script src="/../static/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

        <!--Sidemenu js-->
        <script src="/../static/plugins/toggle-menu/sidemenu.js"></script>

        <!--Scripts js-->
        <script src="/../static/js/scripts.js"></script>
        <!--Toastr js-->
        <script src="/../static/plugins/toastr/build/toastr.min.js"></script>
        <script src="/../static/plugins/toaster/garessi-notif.js"></script>

    </body>
</html>							