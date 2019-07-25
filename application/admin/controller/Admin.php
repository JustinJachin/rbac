<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Admin as AdminModel;

class Admin extends Base {
	public function index(){
		$admin =AdminModel::select();
		$list=AdminModel::where('status',1)->paginate(10);
		$page=$list->render();
		$this->assign('users',$list);
		$this->assign('page',$page);
		return view('index');
	}
}