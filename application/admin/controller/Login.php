<?php


namespace app\admin\controller;


use think\captcha\Captcha;
use think\Controller;
use app\admin\validate\LoginValidate;
use think\Request;
use app\admin\model\Admin as AdminModel;
class Login extends Controller
{
    public function index(){

        $captcha=new Captcha();
        if(request()->isPost()){
            $data=input('post.');
            if(!$captcha->check($data['code'])){
                return $this->error('验证码错误，正在跳转......','','',2);
            }
            $admin=new AdminModel;
            $res=$admin->check($data['email'],$data['password']);
            if($res){
                return $this->redirect('index/index');
            }else{
                return $this->error('邮箱或者密码错误 ，重新填写正在跳转.....','','',2);
            }
        }
//        return view('login');//与$this->fetch()方法相同
        return $this->fetch('login');
    }
    public function  verify(){
        ob_clean();
        $captcha = new Captcha();
        return $captcha->entry();
    }

    
    public function logout(){
        $ip=$this->getIP();
        $admin=new AdminModel;
        $admin->updateLogin($ip);
        session(null);
        $this->redirect('index/login');
    }


    public function getIP(){
        static $realIP;
        if(isset($_SERVER)){
            if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $realIP=$_SERVER['HTTP_X_FORWARDED_FOR'];
            }else if(isset($_SERVER['HTTP_CLIENT_IP'])){
                $realIP=$_SERVER['HTTP_CLIENT_IP'];
            }else{
                $realIP=$_SERVER['REMOTE_ADDR'];
            }
        }else{
            if(getenv('HTTP_X_FORWARDED_FOR')){
                $realIP=getenv('HTTP_X_FORWARDED_FOR');
            }else if(getenv('HTTP_CLIENT_IP')){
                $realIP=getenv('HTTP_CLIENT_IP');
            }else{
                $realIP=getenv('REMOTE_ADDR');
            }
        }
        return $realIP;
    }
}