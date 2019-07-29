<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\model\Permission;
use think\Controller;
use think\facade\Request;

/**
 * 后台基类控制器
 * @author jachin <jachin@qq.com>
 */
class Base extends Controller
{
    /**
     * @description 初始化
     * @author jachin  2019-07-29
     */
    public function initialize(){
        
        $this->is_login();
        $this->getMenu();
        $this->getRole();

    }
    /**
     * @description 登录判断
     * @author jachin  2019-07-29
     */
    public function is_login(){
        $name = session('uid');
        if(!$name){
         $this->error('您没有登录无法访问，请登录账号！','login/index');
        }
    }
    /**
     * @description 获取菜单
     * @author jachin  2019-07-29
     */
    public function getMenu(){
        $menu = new Permission();
        $res  = $menu->getMenu();
        $this->assign('menu',$res);
    }
    /**
     * @description 获得权限
     * @author jachin  2019-07-29
     */
    public function getRole(){

        $adminId=session('uid');

        $status=0;
        //判断session是否存有用户信息
        empty($adminId) && $this->error('你无权访问！请联系管理员','login/index');

        if($adminId!=1){

            $access_id=model('AdminRole')->getRole($adminId);
                // var_dump($access_id);exit;
            
            if(!$access_id){
               $this->error('你无权访问！请联系管理员','login/index');
            }else{
                //获取当前控制器名和方法名
                $method = strtolower(Request::controller()."/".Request::action());

                //查询该控制器方法在权限表中的id
                $id_method=model('Permission')->getPermission($method);
                // var_dump(in_array(2,$access_id));exit;
                if(!in_array($id_method,$access_id)){
                    $this->error('你无权访问！请联系管理员','index/index');
                }
            }
            
           
        }

    }
}