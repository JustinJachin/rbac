<?php


namespace app\admin\model;


use think\Model;
use think\Session;
use think\facade\Request;


class Permission extends Model
{
  //获取器，是否为导航栏
  public function getDisplayMenuAttr($value){
      $displayMenu=[0=>'否',1=>'是'];
      return $displayMenu[$value];
  }
  //获取器，查找上一级栏目
  public function getParentIdArrt($value){
      $parent_id=$this->getParentName();
      return $parent_id[$value];

  }
  //获取器 判断是否已删除
  public function getStatusAttr($value){
      $status=[-1=>'删除',0=>'禁用',1=>'正常'];
      return $status[$value];
  }

 

  //获取目录
  public function getMenu(){
	$controller = Request::controller();
	$action = Request::controller();
	$method=strtolower($controller.'/'.$action);
    $data=['parent_id'=>0,'status'=>1,'display_menu'=>1];
    $result=db('permission')->where($data)->field('id,title,name,icon')->select();
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
  public function getPermission($access){
  	$data=db('Permission')->where('name',$access)->field('id')->find();
  	if($data){
  		return $data['id'];
  	}else{
  		return false;
  	}
  }
  
}