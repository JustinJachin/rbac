<?php


namespace app\admin\model;


use think\Model;
use think\Session;

class AdminRole extends Model
{
    public function getRole($userId){
      	$role_id=db('AdminRole')->where('uid',$userId)->field('role_id')->select();
      	if(empty($role_id)){
            return false;
        }	
        $access_id='';
      	foreach($role_id as $k){
      		// var_dump($k);
      		$res=db('RolePermission')->where('role_id',$k['role_id'])->field('access_id')->find();
      		$access_id=$res['access_id'].'，'.$access_id;
      		
      	}
      	$result=explode('，',$access_id);
      	// var_dump($result);exit;
      	$result=array_values(array_filter(array_unique($result)));
      	if(empty($result)){
      		return false;
      	}
      	return $result;
    }
}