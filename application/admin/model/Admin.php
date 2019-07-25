<?php


namespace app\admin\model;


use think\Model;
use think\Session;

class Admin extends Model
{
    // protected $table = 'on_admin';
    public function getStatusAttr($value){
      $status=[-1=>'删除',0=>'禁用',1=>'正常'];
      return $status[$value];
    }
    
    public function getSexAttr($value){
      $sex=[0=>'女',1=>'男',2=>'保密'];
      return $sex[$value];
    }

    public function getLast_login_timeAttr($value){
      if($value)
        $last_login_time=date('Y-m-s h:i:s',$value);
      else
        $last_login_time='暂无登录';
      return $last_login_time;
    }

    public function getLast_login_ipAttr($value){
      echo $value;
    }

    
    public function check($name,$pwd){
       $email=Admin::where('email',$name)->find();
       $user=Admin::where('name',$name)->find();
       if($user||$email){
           if('on'.md5('on'.md5($pwd))===$user['password']){
              \session('uid',$user['id']);
              \session('admin_name',$user['name']);
               return 1;
           }
       }
       return 0;
    }
    public function updateLogin($ip){
      $data=array(
        'last_login_time' => time(),
        'last_login_ip'   => $ip,
      );
      $userId=session('uid');
      Admin::save($data,['id'=>$userId]);
    }

}