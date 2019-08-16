<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\Role as RoleModel;
use Think\Request;
use app\admin\model\Permission;
use app\admin\model\RolePermission;
use app\admin\validate\Role as RoleValidate;
/**
 * 角色控制器
 * @author jachin <jachin@qq.com>
 */

class Role extends Base{
	/**
     * @description 角色列表页
     * @author jachin  2019-07-29
     */
	public function index(){
		$role=RoleModel::where('status',1)->paginate(5);
		$page=$role->render();
		$this->assign('role',$role);
		$this->assign('page',$page);
		return view();
	}

	/**
     * @description 角色添加
     * @author jachin  2019-07-29
     */
	public function add(){
		if(Request()->isPost()){
			//初始化$res
			$status=array(
				'status'=>0,
				'msg'=>'添加失败'
			);
			$role=input('post.');
			$roleValidate=new RoleValidate();
			$roleRes=$roleValidate->scene('add')->check($role);
			if(!$roleRes){
				$status['msg']=$roleValidate->getError();
				return json($status);
			}
			
			$res=RoleModel::create($role);
			if($res){
				$status=array(
					'status'=>1,
					'msg'=>'添加成功'
				);
			}
			return json($status);

		}else{

			return view();
		}	
	}
	/**
     * @description 角色编辑
     * @author jachin  2019-07-29
     */
	public function edit(Request $request){
		if(Request()->isPost()){
			
			$status['status']=0;

			$roleEdit=input('post.');

			$id=$roleEdit['id'];

			unset($roleEdit['id']);
			$res='';
			$data=RoleModel::where('id',$id)->find();
			$roleValidate=new RoleValidate();
			if($data['name']!=$roleEdit['name']){
				$roleRes=$roleValidate->scene('editName')->check($roleEdit);
				if(!$roleRes){
					$status['msg']=$roleValidate->getError();
					return json($status);
				}
				$res['name']=$roleEdit['name'];
			}
			if($data['description']!=$roleEdit['description']){
				$roleRess=$roleValidate->scene('editDesc')->check($roleEdit);
				if(!$roleRess){
					$status['msg']=$roleValidate->getError();
					return json($status);	
				}
				$res['description']=$roleEdit['description'];
			}

			if(empty($res)){
				$status['msg']='请填写你要更改的地方';
				return json($status);
			}
			$ress=RoleModel::where('id',$id)->update($res);
			if($ress){
				$status=array(
					'status'=>1,
					'msg'=>'修改成功'
				);
			}else{
				$status['msg']='修改失败';
			}
			return json($status);
		}else{
			$id=$request->param('id');
			$role=RoleModel::where('id',$id)->find();
			$this->assign('role',$role);
			return view();
		}
		
	}
	/**
     * @description 权限分配
     * @author jachin  2019-07-29
     */
	public function store(Request $request){
		if(Request()->isPost()){
			$data=input('post.');
			if(!$data){
				$status=array(
					'status'=>0,
					'msg'=>'您的选择为空！'
				);
				return json($status);
			}

			$roleper=RolePermission::where('role_id',$data['id'])->find();
			if(!$roleper){
				$status=array(
					'status'=>0,
					'msg'=>'暂未找到你要修改的数据'
				);
				return json($status);
			}
			$roleper->access_id=$data['data'];
			$res=$roleper->save();
			if($res){
				$status=array(
					'status'=>1,
					'msg'=>'授权成功'
				);

			}else{
				$status=array(
					'status'=>0,
					'msg'=>'授权失败'
				);
			}
			return json($status);
		}else{
			$id=$request->param('id');
			$this->assign('id',$id);
			$permission=new Permission();
			$data=$permission->getRoleInPer($id);
			// var_dump($data);exit;
			$this->assign('access',$data);
			return view();
		}
		
	}
	/**
     * @description 角色删除
     * @author jachin  2019-07-29
     */
	public function delete(Request $request){
		$status['status']=0;
		$id    = intval($request->param('id'));
		if(empty($id)){
			$status['msg']='您重新选择';
			return json($status);
		}
		$map   = array(
			'id'=>$id,
		);
		$res   = RoleModel::where($map)->find();
		$res->status=0;
		$result=$res->save();
		if($result){
			$status=array(
				'status'=> 1,
			 	'msg' => '删除成功',
			 );
		}else{
			$status['msg'] = '删除失败';
		}
		return json($status);
	}
	/**
     * @description 角色批量删除
     * @author jachin  2019-07-29
     */
	public function deletes(Request $request){
		$ids=$request->param('check_val');
		$status['status']=0;
		if(empty($ids)){
			$status['msg']='请选择您要删除的选项！';
			return json($status);
		}
		$map=array();
		foreach ($ids as $key => $value) {
			$map[$key]=['id'=>$value,'status'=>0];
		}
		var_dump(RoleModel::get($map));
		exit;
		$role=new RoleModel();
		$flag=$role->saveAll($map);
		if($flag){
			$status=array(
				'status'=>1,
				'msg'=>'删除成功'
			);
		}else{
			$status['msg']='删除失败';
		}
		return json($status);
	}

}