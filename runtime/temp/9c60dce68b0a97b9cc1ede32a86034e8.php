<?php /*a:3:{s:76:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\login\forget.html";i:1571386888;s:76:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\publics\head.html";i:1571386746;s:78:"E:\phpStudy\PHPTutorial\WWW\tp5rbac\application\admin\view\publics\footer.html";i:1571386715;}*/ ?>
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
            
                
                        
<section class="section">
    <div class="container mt-6 mb-5">
        <div class="row">
            <div class="single-page construction-bg cover-image" data-image-src="/../static/img/news/img14.jpg">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="wrapper ">
                            <form id="Forgot" class="card-body" tabindex="500">
                                <h4>Forgot Your Password?</h4>
                                <div class="mail">
                                    <input type="email" name="mail" id="mail">
                                    <label>email</label>
                                </div>
                                <div class="submit">
                                    <a class="btn btn-primary btn-block" href="#" onclick="sendMessage()">send email</a>
                                </div>
                                <div class="text-center text-dark mt-3 mb-0">
                                    Remember password, <a href="<?php echo url('login/index'); ?>">click here</a> to return to the login page.
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="log-wrapper text-center pt-lg-3 pb-lg-3 ">
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
<script>              
    function sendMessage(){
        var email=$('#mail').val();
        $.ajax({
            type:'post',
            url:"<?php echo url('/admin/login/forget'); ?>",
            data:{'email':email},
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