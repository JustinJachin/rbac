<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\controller;


use think\captcha\Captcha;
use think\Controller;
use app\admin\validate\LoginValidate;
use think\Request;
use app\admin\model\Admin as AdminModel;

/**
 * 后台登录控制器
 * @author jachin <jachin@qq.com>
 */
class Login extends Controller
{
    /**
     * @description  后台首页
     * @author jachin  2019-07-29
     */
    public function index(){
       
        $captcha=new Captcha();
        if(request()->isPost()){
            $data=input('post.');
            if(!$captcha->check($data['code'])){
                return $this->error('验证码错误，正在跳转......','','',2);
            }
            $admin=new AdminModel;
            $res=$admin->check($data['email'],$data['password']);

            switch($res['status']){
                case 0:
                    $this->redirect($res['msg']);

                    break;
                case 1:
                    $this->error($res['msg'],'','',2);
                    break;
                case 2:
                    $this->error($res['msg'],'','',2);
                    break;
                case 3:
                    $this->error($res['msg'],'','',2);
                    break;
                default :$this->error('系统问题，请联系管理员','','',2);
            }
            
        }
        //return view('login');//与$this->fetch()方法相同
        return $this->fetch('login');
    }

    /**
     * @description  验证码
     * @author jachin  2019-07-29
     */
    public function  verify(){
        ob_clean();
        $captcha = new Captcha();
        return $captcha->entry();
    }

    /**
     * @description  退出登录
     * @author jachin  2019-07-29
     */
    public function logout(){
        //获取ip地址
        $ip=get_IP();
        $admin=new AdminModel;
        //将ip地址写入数据库
        $admin->updateLogin($ip);
        //清空session
        session(null);
        $this->redirect('login/index');
    }

   
}