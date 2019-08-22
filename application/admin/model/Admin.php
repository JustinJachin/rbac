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
     * @description  关联log表 admin（1）-log（n） 一对多关系
     * @return array 返回查询到的数据
     * @author jachin  2019-08-16
     */
    public function log(){

      return $this->hasMany('Log');

    }
    /**
     * @description  获取器获取状态，重新赋值
     * @param  int    $value
     * @return string 
     * @author jachin  2019-07-29
     */
    public function scopeStatus($query){

      $query->where('status','<',2);

    }
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
        $status=[
          'status'=>3,
          'msg'=>'该用户不存在'
        ];
        return $status;
      }
      if($user['status']!='正常'){
        $status=[
          'status'=>2,
          'msg'=>'该用户被禁用或删除'
        ];
        get_log('admin_login',$user['id'],'登录失败'.$status['msg']);
        return $status;
      }

      if('on'.md5('on'.md5($pwd))===$user['password']){


          $res=$this->eqValueInRedis($user['id'],$user['name'],Session::sessionid());
          // var_dump($res);exit;
          switch ($res) {
            case 1:
              $status=[
                'status'=>0,
                'msg'=>'index/index'
              ];
              break;
            case 2:
              $status=[
                'status'=>4,
                'msg'=>'你的账号已在其他地方登录'
              ];
              break;
            case 3:
              $status=[
                'status'=>5,
                'msg'=>'你已经登录，请勿重复登录'
              ];
              break;
          }

          if($res===1){
            \session('uid',$user['id']);
            \session('admin_name',$user['name']);
            $this->loginUserDevice($user['id'],$user['name'],session_id());
            get_log('admin_login',$user['id'],'登录成功');
          }
          // return $status;
       }else{
          $status=[
            'status'=>1,
            'msg'=>'账号或者密码错误'
          ];
          get_log('admin_login',$user['id'],'登录失败'.$status['msg']);
       }
      return $status;
    }
    /**
     * @description 判断是否重复登录
     * @param  string $id 用户id
     * @author jachin  2019-08-21
     */
    public function loginRepeat($id){
      $uid=session('uid');
      if($id==$uid){
        return true;
      }
      return false;
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
        'is_login'        =>0,

      );

      $userId=session('uid');
      
      Admin::save($data,['id'=>$userId]);
    }
    public function loginUserDevice($id,$name,$sessionId){
        $redis=connectRedis();
        $cacheName=config('REDIS_NAME').$id;
        $deviceUUID=md5($id+$sessionId+$name);

        $timeout=config('REDIS_TIME');

        $redis->set($cacheName, $deviceUUID);

        $redis->setTimeout($cacheName, $timeout);
        return true;
        
    }
    public function eqValueInRedis($id,$name,$sessionId){
        $redis=connectRedis();
        $cacheName=config('REDIS_NAME').$id;
        $deviceUUID=md5($id+$sessionId+$name);
        $timeout=config('REDIS_TIME');
        $cachedDeviceUUID = $redis->get($cacheName);
        if($cachedDeviceUUID){
          $isTimeout = false;
        }else{
          $isTimeout = true;

        }
        // $isTimeout = false === $cachedDeviceUUID;

        $isTheRightDevice = $deviceUUID === $cachedDeviceUUID;

        if($isTimeout){
            return 1;
        }

        if($isTheRightDevice){
          $redis->setTimeout($cacheName, $timeout);
          return 3;
        }

        return 2;
    }
    
}