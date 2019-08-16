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
					->order('id')
					->paginate(10,false,$pageParam);
		}else{
			
			$list=LogModel::where('status',1)->order('id')->paginate(10,false,$pageParam);
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
		$id=intval($request->param('id'));

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
     * @author jachin  2019-08-16
     */
	public function clear(){

	}
	/**
     * @description 日志导出
     * @author jachin  2019-08-16
     */
	public function derive(){

	}
}