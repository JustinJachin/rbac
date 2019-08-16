<?php

// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------
namespace app\admin\model;


use think\Model;
use think\Session;
use app\admin\model\RolePermission;
use think\facade\Request;
use app\admin\model\Module;
/**
 * 权限模型
 * @author jachin <jachin@qq.com>
 */

class Permission extends Model
{
    /**
     * @description  关联icon表 icon（1）-permission（n） 一对多关系
     * @return array 返回查询到的数据
     * @author jachin  2019-08-08
     */
    public function icons(){
      return $this->belongsTo('Icon');
    }
    /**
     * @description  关联module表 module（1）-permission（n） 一对多关系
     * @return array 返回查询到的数据
     * @author jachin  2019-08-08
     */
    public function modules(){
      return $this->belongsTo('Module');
    }
    /**
     * @description  获取目录
     * @return string 返回名字
     * @author jachin  2019-07-29
     */
    public function getRoleInPer($id){
      $rolePer=RolePermission::where('role_id',$id)->field('access_id')->find();
      $rolepers=explode(',',$rolePer['access_id']);
      // var_dump($rolepers);exit;
      $module=new Module();
      $module_id=$module->getModuleId();
       $data=[
        'status'=>1,
        'module_id'=>$module_id,
      ];
      $permission=$this::where($data)->field('id,title,parent_id')->select();
      foreach ($permission as $k=>$v) {
        if(in_array($v['id'], $rolepers)){
          $v['flag']=1;
        }else{
          $v['flag']=0;
        }
        // $v['children']='';
      }
      
      $perTree=$this->permissionTree($permission);
      return $perTree;
      
    }

    public function permissionTree($arr, $pid = 0) {
        $tree = array();                                //每次都声明一个新数组用来放子元素
        foreach($arr as $v){
          //匹配子记录
            if($v['parent_id'] == $pid){

                $v['children'] =self::permissionTree($arr,$v['id']); //递归获取子记录
                // if($v['children'] == null){
                //     unset($v['children']);             //如果子元素为空则unset()进行删除，说明已经到该分支的最后一个元素了（可选）
                // }
                //将记录存入新数组
                $tree[] = $v;
                // unset($arr[$v]);                       
            }
        }
        return $tree;
        // $tree = '';
        // foreach ($arr as $k => $v) {
        //     // 不断循环，获取父分类下的子分类
        //     if ($v['parent_id'] == $pid) {
        //         // 父亲找到儿子
        //         $v['children'] = self::permissionTree($arr, $v['id']);
        //         $tree[] = $v;
        //         unset($arr[$k]);
        //     }
        // }
        // return $tree;
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
      $module=new Module();
      $module_id=$module->getModuleId();

      $data=[
        'parent_id'=>0,
        'status'=>1,
        'display_menu'=>1,
        'module_id'=>$module_id,
      ];
      //查询
      $result=$this::with('icons')->where($data)->select();
      // var_dump($result);exit;
      foreach($result as &$v){
      	$v['star']=false;
      	if($method===$v['name']){
      		$v['star']=true;
      	}
      	$date=['parent_id'=>$v['id'],'status'=>1,'display_menu'=>1];
        $res=$this::where($date)->select();
      	// $res=db('permission')->where($date)->field('id,title,name')->select();
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
}