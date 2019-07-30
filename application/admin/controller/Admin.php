<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\Admin as AdminModel;
use think\Request;
use app\admin\validate\Admin as AdminValidate;


/**
 * 管理员控制器
 * @author jachin <jachin@qq.com>
 */

class Admin extends Base 
{
	/**
     * @description 管理员列表页
     * @author jachin  2019-07-29
     */
	public function index(){

		$list=AdminModel::where('status','<',2)->order('id')->paginate(10);//每页查询10条数据

		$page=$list->render();

		$this->assign('users',$list);

		// $this->assign('page',$page);

		return view('index',compact('page'));
	}
	
	/**
     * @description 管理员禁用与启用     ------需要优化
     * @author jachin  2019-07-30
     */

	public function store(Request $request){
       
        $id= intval($request->param('id'));
        $method=$request->param('method');

        $this->is_admin_oneself($id);

		$admin=AdminModel::where('id',$id)->find();
		if($method==='start'){
			$admin->status =1;
		}else{
			$admin->status =0;
		}
		$res=$admin->save();
		if($res){
			if($method==='start'){
				$msg='启用成功';
			}else{
				$msg='禁用成功';
			}
			$this->success($msg,'admin/index');
			// $data=array(
			// 	'status'=>1,
			// 	'msg'   =>'修改成功'
			// );
		}else{
			if($method==='start'){
				$msg='启用失败';
			}else{
				$msg='禁用失败';
			}
			$this->error($msg,'admin/index');
			// $data=array(
			// 	'status'=>0,
			// 	'msg'   =>'修改失败'
			// );
		}
		// return json($data);
	}
	/**
     * @description 管理员添加页面以及处理
     * @author jachin  2019-07-29
     */
	public function delete(Request $request){
		$id=intval($request->param('id'));
		$this->is_admin_oneself($id);
		$admin=AdminModel::where('id',$id)->find();
		$admin->status=2;
		$res=$admin->save();
		if($res){
			$this->success('删除成功','admin/index');
		}else{
			$this->error('删除失败','admin/index');
		}
	}
	/**
     * @description 查看该账号是否为超级管理员帐号或者是否为自己账号
     * @param  int    $id 要操作的用户id
     * @author jachin  2019-07-29
     */
	public function is_admin_oneself($id){
		if($id===1){
        	$this->error('该账号是超级管理员，无法对其操作','admin/index');
        }
        if($id===session('uid')){
        	$this->error('无法对自己账号操作','admin/index');
        }
	}
	/**
     * @description 管理员添加页面以及处理
     * @author jachin  2019-07-29
     */
	public function add(){

		//判断页面是否有数据提交

		if(Request()->isPost()){
			//初始化$res
			$status=array(
				'status'=>0,
				'msg'=>'添加失败'
			);
			//获取前台提交的数据
			$data=input('post.');
			
			$adminValidate=new AdminValidate();
			//验证数据是否合法
			$result=$adminValidate->check($data);
			if(!$result){
				$status=array(
					'status'=>0,
					'msg'=>$adminValidate->getError()
				);
			}else{
				$data['password']='on'.md5('on'.md5($data['password']));//密码加密
				unset($data['password_confirm']);//剔除重复密码
				$data['create_time']=time();
				$data['update_time']=time();
				$res=AdminModel::create($data);//加入数据库
				if($res){
					$status=array(
						'status'=>1,
						'msg'=>'添加成功'
					);
				}
			}
			//返回json格式数据
			return json($status);

		}else{
			//页面展示
			return view('add');
		}
		
	}
}