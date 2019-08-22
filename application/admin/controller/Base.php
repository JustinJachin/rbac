<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\model\Permission;
use think\Controller;
use think\facade\Request;
use app\admin\model\Module;
use think\Session;

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
        $this->extendDeviceInfoTTL();
        // if(!$res){
        //     $this->error('你的账号已被登录，请联系管理员帮你修改密码','login/index');
        // }
        // $admin=model('Admin')->eqValueInRedis(session('uid'),session('admin_name'));
        // if($admin){
        //     $this->error('您没有登录无法访问，请登录账号！','login/index');
        // }
        $this->getMenu();
        $this->getRole();

    }
    /**
     * @description 登录判断
     * @author jachin  2019-07-29
     */
    public function is_login(){
        $uid = session('uid');
        // var_dump($uid);exit;
        if(!$uid){
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
     * @description 检测权限
     * @author jachin  2019-07-29
     */
    public function getRole(){

        $adminId=session('uid');
        $module=new Module();
        $module_id=$module->getModuleId();
        $status=0;
       
        //判断session是否存有用户信息
        empty($adminId) && $this->error('你无权访问！请联系管理员','login/index');

        if($adminId!=1){

            $access_id=model('AdminRole')->getRole($adminId,$module_id);

            if(!$access_id){
               $this->error('你无权访问！请联系管理员','login/index');
            }else{
                //获取当前控制器名和方法名
                $method = strtolower(Request::controller()."/".Request::action());

                //查询该控制器方法在权限表中的id
                $id_method=model('Permission')->getPermission($method);

                if(!in_array($id_method,$access_id)){
                    $this->error('你无权访问！请联系管理员');
                }
            }
            
           
        }

    }
    public function extendDeviceInfoTTL(){

        $redis=connectRedis();

        $cacheName=config('REDIS_NAME').session('uid');
        $deviceUUID=md5(session('uid')+Session::sessionId()+session('admin_name'));
        $timeout=config('REDIS_TIME');
        $cachedDeviceUUID = $redis->get($cacheName);
        $isTimeout = false === $cachedDeviceUUID;
// var_dump($isTimeout);exit;
        $isTheRightDevice = $deviceUUID === $cachedDeviceUUID;
        if($isTimeout){
            return $this->error('你登录帐号有效期已到，请重新登录账号','login/index');
        }
        // if()

        if(!$isTheRightDevice){

           return $this->error('你的账号已被登录，请联系管理员帮你修改密码','login/index');

        }

        $redis->setTimeout($cacheName, $timeout);

        return true;

    }

}