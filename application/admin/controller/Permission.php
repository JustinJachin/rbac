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
use app\admin\validate\Permission as PermissionValidate;
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
		// $article = PermissionModel::get(20);
		// // 获取文章的所有评论
		// dump($article->icons);exit;
		$list=PermissionModel::with('icons,modules')->where('status','1' )->paginate(10);
		// var_dump($list);exit;
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
	public function add(Request $request){
		if(Request()->isPost()){
			$data=input('post.');
			$status['status']=0;
			$permissionValidate=new PermissionValidate();
			$res=$permissionValidate->check($data);
			if(!$res){
				$status['msg']=$permissionValidate->getError();
				return json($status);
			}
			$map=explode('/', $data['name']);

			$data['controller']=$map[0];
			$data['action']=$map[1];
			$result=PermissionModel::create($data);
			if($result){
				get_log('add',\session('uid'),'添加了--'.$data['title'].'--菜单');
				$status['status']=1;
				$status['msg']='添加成功';
			}else{
				$status['msg']='添加失败';
			}
			return json($status);
		}else{
			$map=[
				'display_menu'=>1,
				'status'=>1,
				'module_id'=>1
			];
			$menu=PermissionModel::where($map)->field('id,title,parent_id')->select();

			$ptree=new PermissionModel();

			$res=$ptree->permissionTree($menu);
			$icon=Icon::where('status',1)->select();
			$module=ModuleModel::select();

			$this->assign('permission',$res);
			$this->assign('module',$module);
			$this->assign('icon',$icon);

			return view();
		}
	}
	

	/**
     * @description  权限编辑
     * @author jachin  2019-08-07
     */
	public function edit(Request $request){
		if(Request()->isPost()){
			$data=input('post.');
			$status['status']=0;

			$id=$data['id'];
			unset($data['id']);
			$pers=PermissionModel::get($id);
			if($pers['name']==$data['name']|empty($data['name'])){
				unset($data['name']);
			}else{
				$map=explode('/', $data['name']);
				$data['controller']=$map[0];
				$data['action']=$map[1];
			}
			if($data['title']==$pers['title']|empty($data['title'])){
				unset($data['title']);
			}
			if($data['module_id']==$pers['module_id']|empty($data['module_id'])){
				unset($data['module_id']);
			}
			if($data['parent_id']==$pers['parent_id']){
				unset($data['parent_id']);
			}
			$display_menu=($data['display_menu']==1?'是':'否');
			if($display_menu==$pers['display_menu']){
				unset($data['display_menu']);
			}

			if($data['icon_id']==$pers['icon_id']|empty($data['icon_id'])){
				unset($data['icon_id']);
			}
			
			if(empty($data)){
				$status['msg']='你未修改信息，请修改后提交';
				return json($status);

			}
			$result=PermissionModel::where('id',$id)->update($data);
			if($result){
				get_log('update',\session('uid'),'编辑了ID为'.$id.'的菜单');
				$status['status']=1;
				$status['msg']='更新成功';
			}else{
				$status['msg']='更新失败';
			}
			return json($status);

		}else{

			$id=$request->param('id');
			$permission=PermissionModel::get($id);
			
			$this->assign('map',$permission);

			$map=[
				'display_menu'=>1,
				'status'=>1
			];
			$menu=PermissionModel::where($map)->field('id,title,parent_id')->select();
			$ptree=new PermissionModel();
			$res=$ptree->permissionTree($menu);
			$this->assign('permission',$res);
			$module=ModuleModel::select();
			$this->assign('module',$module);
			$icon=Icon::where('status',1)->select();
			$this->assign('icon',$icon);
			return view();
		}
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
			get_log('delete',\session('uid'),'id为'.$id.'的菜单被删除');
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
			get_log('deletes',\session('uid'),'id为'.implode(',',$ids).'的日志被删除');
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