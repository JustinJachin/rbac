<?php


namespace app\admin\controller;

use app\admin\model\Permission;
use think\Controller;
use think\facade\Request;
class Base extends Controller
{
    public function initialize(){
        $this->is_login();
        $this->getMenu();
        $this->getRole();

    }
    public function is_login(){
        $name = session('uid');
        if(!$name){
         $this->error('您没有登录无法访问，请登录账号！','login/index');
        }
    }
    public function getMenu(){
        $menu = new Permission();
        $res  = $menu->getMenu();
        $this->assign('menu',$res);
    }
    public function getRole(){
        $adminId=session('uid');
        empty($adminId) && $this->error('你无权访问！请联系管理员');
        if($adminId!=1){
            $access_id=model('AdminRole')->getRole($adminId);
            if(!$access_id){
               $this->error('你无权访问！请联系管理员'); 
            }
            $method = strtolower(Request::controller()."/".Request::controller());
            $id_method=model('Permission')->getPermission($method);
            if(in_array($id_method,$access_id)){
                $this->error('你无权访问！');
            }
        }

    }
}