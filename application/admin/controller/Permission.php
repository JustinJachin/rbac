<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Permission as PermissionModel;


/**
 * 权限控制器
 * @author jachin <jachin@qq.com>
 */

class Permission extends Base{

	/**
     * @description  权限列表
     * @author jachin  2019-07-29
     */
	public function index(){
		
		$list=PermissionModel::where('status','1' )->paginate(10);
		//遍历赋值父级名
		foreach($list as &$k){
			$k['parentName']=$this->getParentName($k['parent_id']);
		}
		$page=$list->render();
		$this->assign('permission',$list);
		$this->assign('page',$page);
		return view('index');
	}

	/**
     * @description  获取父级权限名
     * @param  int    $value
     * @return string 返回名字
     * @author jachin  2019-07-29
     */
	public function getParentName($value){
	    $parentName=PermissionModel::where('id',$value)->find();
	    if(!$parentName){
	    	$res='顶级菜单';
	    }else{
	    	$res=$parentName['title'];
	    }
	    
	    return  $res;
	}
}