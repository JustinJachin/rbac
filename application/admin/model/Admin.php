<?php

// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\model;


use think\Model;
use think\Session;
use think\facade\Validate;

/**
 * 管理员模型
 * @author jachin <jachin@qq.com>
 */
class Admin extends Model
{
   
    /**
     * @description  获取器获取状态，重新赋值
     * @param  int    $value
     * @return string 
     * @author jachin  2019-07-29
     */
    public function getStatusAttr($value){
      $status=[2=>'删除',0=>'禁用',1=>'正常'];
      return $status[$value];
    }
    
    /**
     * @description  获取器获取性别，重新赋值
     * @param  int    $value
     * @return string 
     * @author jachin  2019-07-29
     */
    public function getSexAttr($value){
      $sex=[0=>'女',1=>'男',2=>'保密'];
      return $sex[$value];
    }

    /**
     * @description  获取器获取时间，重新赋值
     * @param  int    $value
     * @return string 
     * @author jachin  2019-07-29
     */
    public function getLast_login_timeAttr($value){
      if($value)
        $last_login_time=date('Y-m-s h:i:s',$value);
      else
        $last_login_time='暂无登录';
      return $last_login_time;
    }

    /**
     * @description  登录验证
     * @param  string $name 用户名 string $pwd 密码 
     * @return bool 正确返回1错误返回0
     * @author jachin  2019-07-29
     */
    public function check($name,$pwd){
      //查找登录邮箱
      if(Validate::isEmail($name)){
        $user=Admin::where('email',$name)->find();
      }else{
        $user=Admin::where('name',$name)->find();
      }
      if(empty($user)){
        return 3;
      }
      if($user['status']!='正常'){
        return 2;
      }
      if($user){
         if('on'.md5('on'.md5($pwd))===$user['password']){
            \session('uid',$user['id']);
            \session('admin_name',$user['name']);
             return 0;
         }else{
          return 1;
         }
      }
      
    }

    /**
     * @description  更新登录信息
     * @param  string $ip ip地址
     * @author jachin  2019-07-29
     */
    public function updateLogin($ip){
      $data=array(
        'last_login_time' => time(),
        'last_login_ip'   => $ip,
      );
      $userId=session('uid');
      Admin::save($data,['id'=>$userId]);
    }

}