<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Admin as AdminModel;
use think\Request;
class Admin extends Base {
	public function index(){
		$admin =AdminModel::select();
		$list=AdminModel::where('status',1)->paginate(10);
		$page=$list->render();
		$this->assign('users',$list);
		$this->assign('page',$page);
		return view('index');
	}
	public function addadmin(){
		// if(Request){
		// 	$data=array(
		// 		'status'=>1,
		// 		'msg'=>'注册成功'
		// 	);
		// 	return json_decode($data);
		// }else{
		// 	return view('add');
		// }
		return view('add');
	}
	// public function add($username='',$sex='',$email='',$password='',$passwordTwo=''){
	// 	// halt($request->post());
	// 	// $data=request()->post();
	// 	// var_dump($data);exit;
	// 	echo $username.' sex'.$sex.' email:'.$email.'  password:'.$password;
	// 	$data=array(
	// 		'status'=>1,
	// 		'msg'=>'注册成功'
	// 	);
	// 	return json($data);
	// }
	public function add(){
		// halt($request->post());
		$data=input('post.username');
		var_dump($data);
		// $data=array(
		// 	'status'=>1,
		// 	'msg'=>'注册成功'
		// );
		// var_dump($data);exit;
		return json($data);
	}
}