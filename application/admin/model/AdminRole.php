<?php

// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------
namespace app\admin\model;


use think\Model;
use think\Session;
/**
 * 管理员-角色模型
 * @author jachin <jachin@qq.com>
 */
class AdminRole extends Model
{
    /**
     * @description  获取父级权限名
     * @param  int    $value
     * @return string 返回名字
     * @author jachin  2019-07-29
     */
    public function getRole($userId){
      	$role_id=db('AdminRole')->where('uid',$userId)->field('role_id')->select();
      	if(empty($role_id)){
            return false;
        }	
        $access_id='1，22';
      	foreach($role_id as $k){
      		// var_dump($k);
      		$res=db('RolePermission')->where('role_id',$k['role_id'])->field('access_id')->find();
          if($res){
            $access_id=$res['access_id'].'，'.$access_id;
          }
      		
      		
      	} 
        // var_dump($access_id);exit;
      	$result=explode('，',$access_id);
      	
      	$result=array_values(array_filter(array_unique($result)));
      	if(empty($result)){
      		return false;
      	}
      	return $result;
    }
}