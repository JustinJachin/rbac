<?php

// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------
namespace app\admin\model;


use think\Model;
use think\Session;
use think\facade\Request;
/**
 * 权限模型
 * @author jachin <jachin@qq.com>
 */

class Permission extends Model
{
  /**
   * @description  获取器，是否为导航栏
   * @return string 返回名字
   * @author jachin  2019-07-29
   */
  public function getDisplayMenuAttr($value){
      $displayMenu=[0=>'否',1=>'是'];
      return $displayMenu[$value];
  }
  /**
   * @description  获取器，查找上一级栏目
   * @return string 返回名字
   * @author jachin  2019-07-29
   */
  public function getParentIdArrt($value){
      $parent_id=$this->getParentName();
      return $parent_id[$value];

  }

  /**
   * @description  获取器 判断是否已删除
   * @return string 返回名字
   * @author jachin  2019-07-29
   */
  public function getStatusAttr($value){
      $status=[-1=>'删除',0=>'禁用',1=>'正常'];
      return $status[$value];
  }

  /**
   * @description  获取目录
   * @return string 返回名字
   * @author jachin  2019-07-29
   */
  public function getMenu(){
    //获取控制器名和方法名
  	$controller = Request::controller();
  	$action = Request::action();
    //拼接方法名和控制器名
  	$method=strtolower($controller.'/'.$action);
    $data=['parent_id'=>0,'status'=>1,'display_menu'=>1];
    //查询
    $result=$this::where($data)->field('id,title,name,icon')->select();
    foreach($result as &$v){
    	$v['star']=false;
    	if($method===$v['name']){
    		$v['star']=true;
    	}
    	$date=['parent_id'=>$v['id'],'status'=>1,'display_menu'=>1];
    	$res=db('permission')->where($date)->field('id,title,name')->select();
    	foreach($res as &$value){
    		$value['star']=false;
    		if($method===$value['name']){
    			$value['star']=true;
    		}
    	}
    	if($res)
    		$v['children']=$res;
    	else
    		$v['children']=1;
    }

    return $result;
  }
  /**
   * @description  获取权限id
   * @param  string    $access 控制器名和方法
   * @return string 
   * @author jachin  2019-07-29
   */
  public function getPermission($access){
    //判断是否存在该表中\

  	$data=db('Permission')->where('name',$access)->field('id')->find();

  	if($data){
  		return $data['id'];
  	}else{
  		return false;
  	}
  }
  
}