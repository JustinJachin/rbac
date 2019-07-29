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

		$list=AdminModel::where('status',1)->paginate(10);//每页查询10条数据

		$page=$list->render();

		$this->assign('users',$list);

		$this->assign('page',$page);

		return view('index');
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

	// public function add(){
		
	// }
}