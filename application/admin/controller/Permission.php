<?php


namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Permission as PermissionModel;



class Permission extends Base{
	public function index(){
		
		$list=PermissionModel::paginate(10);
		foreach($list as &$k){
			$k['parentName']=$this->getParentName($k['parent_id']);
		}
		$page=$list->render();
		$this->assign('permission',$list);
		$this->assign('page',$page);
		return view('index');
	}
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