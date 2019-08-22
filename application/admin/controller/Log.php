<?php

// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\Log as LogModel;
// use think\Request;
use app\admin\common;
use app\admin\model\Admin;
use app\admin\model\Action;
use think\facade\Request;
use app\admin\controller\Office;
use app\admin\controller\ExcelOffice;


/**
 * 后台日志控制器
 * @author jachin <jachin@qq.com>
 */
class Log extends Base
{
	
	/**
     * @description 日志列表页
     * @author jachin  2019-08-16
     */
	public function index(){
		$keyword=input('get.keyword');
		$pageParam    = ['query' =>[]];
		if($keyword){
			$pageParam['query']['keyword'] = $keyword;
		}
		if(!empty($keyword)){
			$mapAdmin=[
				['name','like',"%{$keyword}%"],
				];
			$admin_id=Admin::where($mapAdmin)->field('id')->select();
			$mapAction=[
					['actionTitle','like',"%{$keyword}%"],
				];
			$action_id=Action::where($mapAction)->field('id')->select();
			$map=[
				['admin_id','in',$admin_id,'or'],
				['action_id','in',$action_id],
			];
			$list=LogModel::where('status',1)
					->where('browser|model|os|remark','like',"%{$keyword}%")
					->whereOr($map)
					->order('id desc')
					->paginate(10,false,$pageParam);
		}else{
			
			$list=LogModel::where('status',1)->order('id desc')->paginate(10,false,$pageParam);
		}
		
		$page=$list->render();
		$this->assign('keyword',$keyword);
		return view('index',['list'=>$list,'page'=>$page]);
	}
	/**
     * @description 日志删除
     * @author jachin  2019-08-16
     */
	public function delete(Request $request){
		$id=intval(input('get.id'));

		if(empty($id)){
			$status=[
				'status'=>0,
				'msg'=>'你尚未选择删除的选项，请重新选择',
			];
			return json($status);
		}
		
		$log=LogModel::find($id);
		$log->status=0;
		$res=$log->save();
		if($res){
			get_log('delete',\session('uid'),'id为'.$id.'的日志被删除');
			$status=[
				'status'=>1,
				'msg'=>'删除成功',
			];
		}else{
			$status=[
				'status'=>0,
				'msg'=>'删除失败',
			];
		}
		
		
		return json($status);
	}	
	/**
     * @description 日志批量删除
     * @author jachin  2019-08-16
     */
	public function deletes(){
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
		$log=new LogModel();
		$res=$log->saveAll($map);
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
     * @description 日志清空
     * @author jachin  2019-08-17
     */
	public function clear(){
		$type=input('post.type');
		$status=[
			'status'=>0,
			'msg'=>'操作失败',
		];
		if(!empty($type)){
			$res=LogModel::where('1=1')->delete();
			if($res){
				get_log('clear',\session('uid'),'日志清空');
				$status=[
					'status'=>1,
					'msg'=>'日志清空成功！',
				];
			}else{
				$status['msg']='日志清空失败';
			}
		}
		return json($status);
	}
	/**
     * @description 日志导出
     * @author jachin  2019-08-16
     */
	public function derive(){
		$field=input('post.obj');
		$fields='';
		$id=input('post.obj_id');
		$head=[
 			'id'=>'日志编号', 
 			'IP'=>'访问地址',
 			'browser'=>'访问浏览器', 
 			'os'=>'访问系统', 
 			'model'=>'访问模块', 
 			'remark'=>'访问备注', 
 			'status'=>'访问状态', 
 			'create_time'=>'访问时间', 
 			'admin_name'=>'访问人', 
 			'action_name'=>'访问行为'
 		];
		if(!empty($id)){
			$map=[
				['id','in',$id],
			];
		}else{
			$map='';
		}
		if(!empty($field)){
			$fields=implode(',',$field);
			if(!in_array('action_id',$field)){
				$fields=$fields.',action_id';
			}
			if(!in_array('admin_id',$field)){
				$fields=$fields.',admin_id';
			}
			$adminParam=['admin_name','action_name'];
			$field=array_merge($field,$adminParam);
			$field=array_diff($field,['action_id','admin_id']);
			foreach ($field as $key => $value) {
	 			if(array_key_exists($value,$head)){
	 				$header[$value]=$head[$value];
	 			}
	 		}       

		}else{
			$header=$head;
		}

		$data=LogModel::where($map)->field($fields)->select();
		
		foreach ($data as $key => $value) {
			$data[$key]['admin_name']=$value['admin']['name'];
			$data[$key]['action_name']=$value['action']['actionTitle'];
			unset($value['admin']);
			unset($value['action']);
			unset($value['action_id']);
			unset($value['admin_id']);
		}
		

		// $excel=new ExcelOffice();
		// $excel->daysales_excel();
		
		$excel = new Office();

		$res=$excel->outdata($data, $header,'日志表');
		if($res){
			get_log('getExcel',\session('uid'),'导出日志表格');
			$status=[
				'status'=>1,
				'res'=>$res,
				'msg'=>'下载成功!',
			];
			
		}else{
			$status=[
				'status'=>0,
				'msg'=>'下载失败!',
			];
		}
		return json($status);
	}
}