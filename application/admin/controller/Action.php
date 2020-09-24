<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------


namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Action as ActionModel;
use think\Request;
use app\admin\validate\Action as ActionValidate;
/**
 * 行为控制器
 * @author jachin <jachin@qq.com>
 */
class Action extends Base{
	/**
     * @description 行为列表页
     * @author jachin  2019-08-15
     */
	public function index(){
		$action=ActionModel::where('status',1)->order('id')->paginate(10);
		$page=$action->render();

		return view('index',['action'=>$action,'page'=>$page]);
	}
	/**
	* @description 行为修改
     * @author jachin  2019-08-15
	*/
	public function edit(Request $request){
		if(Request()->isPost()){
			$datas=$request->param();
			$id=$datas['id'];
			$status['status']=0;
			unset($datas['id']);
			$action=ActionModel::find($id);
			$map=array();
			foreach ($datas as $key => $value) {
				if(empty($value)){
					$status['msg']='输入栏不允许空值哦';
					return json($status);
				}
				
			}
			
			if($datas['actionName']!=$action['actionName']){
				$actionname=['actionName'=>$datas['actionName']];
				$actionvalidate=new ActionValidate();
				
				$res=$actionvalidate->scene('edit')->check($actionname);

				if(!$res){
					$status['msg']=$action->getError();	
					return json($status);				
				}

				$map['actionName']=$datas['actionName'];
			}
			if($datas['actionTitle']!=$action['actionTitle']){
				$map['actionTitle']=$datas['actionTitle'];
			}
			if($datas['remark']!=$action['remark']){
				$map['remark']=$datas['remark'];
			}
			if(empty($map)){
				$status['msg']='你未修改信息';
				return json($status);
			}
			$res=ActionModel::where('id',$id)->update($map);
			if($res){
				get_log('update',\session('uid'),'修改了id为'.$id.'的行为信息');
				$status=[
					'status'=>1,
					'msg'=>'修改成功'
				];
			}else{
				$status['msg']='修改失败';
			}
			return json($status);
			
		}else{
			$id=$request->param('id');
			if(empty($id)){
				return $this->error('参数错误','action/index','',2);
			}
			$data=ActionModel::find($id);
			if(!$data){
				return $this->error('参数错误','action/index','',2);
			}
			return view('edit',['vo'=>$data]);
		}
	}

	/**
	* @description 行为添加
     * @author jachin  2019-08-15
	*/
	public function add(Request $request){
		if(Request()->isPost() ){
			$status['status']=0;
			$data=$request->param();
			$actionValidate=new ActionValidate();
			if(!$actionValidate->check($data)){
				$status['msg']=$actionValidate->getError();
				return json($status);
			}
			$res=ActionModel::create($data);
			if($res){
				get_log('add',\session('uid'),'添加了了id为'.$res['id'].'的行为信息');
				$status=[
					'status'=>1,
					'msg'=>'添加成功',
				];
			}else{
				$status['msg']='添加失败';
			}
			return json($status);
			
		}else{
			return view();
		}
	}
	/**
	* @description 行为删除
     * @author jachin  2019-08-15
	*/
	public function delete(Request $request){
		$id=$request->param('id');
		if(empty($id)){
			$status=[
				'status'=>0,
				'msg'=>'你尚未选择删除的选项，请重新选择',
			];
			return json($status);
		}
		
		$action=ActionModel::find($id);
		$action->status=0;
		$res=$action->save();
		if($res){
			get_log('delete',\session('uid'),'删除了id为'.$id.'的行为信息');
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
	* @description 批量删除
     * @author jachin  2019-08-15
	*/
	public function deletes(Request $request){
		$ids=$request->param('check_val');
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
		$action=new ActionModel();
		$res=$action->saveAll($map);
		if($res){
			get_log('deletes',\session('uid'),'批量删除了id为'.implode(',',$ids).'的行为信息');
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
}