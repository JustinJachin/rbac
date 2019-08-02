<?php

// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------
namespace app\admin\model;


use think\Model;
use think\Session;
use app\admin\model\Permission;
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
      	$role_id=db('AdminRole')->where('uid',$userId)->field('role_id')->find();
        // var_dump($role_id);exit;
      	if(empty($role_id)){
            return false;
        }	

        $role_id=explode('，', $role_id['role_id']);
        $access_id='1，22';
      	foreach($role_id as $k){
          //查看用户所拥有的角色是否被删除
      		$roleStatus=db('Role')->where('id',$k)->field('status')->find();
          if($roleStatus['status']==1){
            
            $res=db('RolePermission')->where('role_id',$k)->field('access_id')->find();

            if($res){
              $access_id=$res['access_id'].'，'.$access_id;
            }

          }
      		
      	} 

      	$result=explode('，',$access_id);
      	
      	$result=array_values(array_filter(array_unique($result)));
        //查看权限是否被删除
        foreach ($result as $key=>$value ) {
          $map=array(
              'id' => $value,
              'status'  => 1
            );
          $perssion=Permission::where($map)->field('id')->find();
          
          if(!$perssion){
            unset($result[$key]);
          }
        }

      	if(empty($result)){
      		return false;
      	}
      	return $result;
    }
}