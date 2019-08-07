<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Permission as PermissionModel;
use Think\Request;
use app\admin\model\Icon;
use app\admin\model\Module as ModuleModel;
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
     * @description  权限添加
     * @author jachin  2019-08-07
     */
	public function add(){
		$icon=Icon::where('status',1)->select();
		$module=ModuleModel::select();
		$this->assign('module',$module);
		$this->assign('icon',$icon);
		return view();
	}
	/**
     * @description  权限编辑
     * @author jachin  2019-08-07
     */
	public function edit(){

	}
	/**
     * @description  权限删除
     * @author jachin  2019-08-07
     */
	public function delete(Request $request){
		$id=intval($request->param('id'));
		if(empty($id)){
			$status=[
				'status'=>0,
				'msg'=>'请选择你要删除的选项'
			];
			return json($status);
		}
		$permission=PermissionModel::where('id',$id)->find();
		$permission->status=0;
		$res=$permission->save();
		if($res){
			$status=[
				'status'=>1,
				'msg'=>'删除成功'
			];
		}else{
			$status=[
				'status'=>1,
				'msg'=>'删除失败'
			];
		}
		return json($status);
	}
	/**
     * @description  权限批量删除
     * @author jachin  2019-08-07
     */
	public function deletes(Request $request){
		$ids=input('post.check_val');
		if(empty($ids)){
			$status=[
				'status'=>0,
				'msg'=>'请选择你要删除的选项'
			];
			return json($status);
		}
		$map=array();
		foreach ($ids as $key => $value) {
			$map[$key]=['id'=>$value,'status'=>0];
			
		}
		$permission=new PermissionModel();
		$res=$permission->saveAll($map);
		if($res){
			$status=[
				'status'=>1,
				'msg'=>'删除成功'
			];
		}else{
			$status=[
				'status'=>0,
				'msg'=>'删除失败'
			];
		}
		return json($status);
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