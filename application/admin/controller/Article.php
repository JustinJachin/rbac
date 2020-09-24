<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Cate;
use app\admin\model\Article  as ArticleModel;
use think\Request;
use app\admin\validate\Article as ArticleValidate;
/**
 * 文章控制器
 * @author jachin <jachin@qq.com>
 */
class Article extends Base
{
	/**
     * @description 文章分类
     * @author jachin  2020-08-05
     */
	public function cate(){
		$start=input('get.start');
		$name=input('get.name');
		$pageParam    = ['query' =>[]];
		if($start){
			$pageParam['query']['start'] = $start;
			$data=explode(' ~ ',$start);
			$mapTime=[['create_time','between time',$data]];
		}else{
			$mapTime='';
		}
		if($name){
			$pageParam['query']['name'] = $name;
			$mapName=[['name','like',"%".$name."%"]];
		}else{
			$mapName='';
		}		

		$list=Cate::where('status',1)->where($mapName)->where($mapTime)->order('id desc')->paginate(10,false,$pageParam);
		$page=$list->render();
		return view('cate',['list'=>$list,'page'=>$page,'start'=>$start,'name'=>$name]);
	}
	/**
     * @description 分类添加
     * @author jachin  2020-08-05
     */
	public function cateAdd(){
		if(Request()->isPost()){
			$data=input('post.');
			if($data['name']==''||$data['sort']==''){
				$msg['msg']='参数不能为空';
				$msg['status']=0;
				return json($msg);
			}
			if(!is_numeric($data['sort'])){
				$msg['msg']='排序只能为数字';
				$msg['status']=0;
				return json($msg);
			}
			$data['create_time']=time();
			$res=Cate::create($data,['name','sort','create_time'],true);
			if($res){
				$msg['msg']='添加成功';
				$msg['status']=1;
				
			}else{
				$msg['msg']='添加失败';
				$msg['status']=0;
			}
			return json($msg);
		}else{
			return view('cateAdd');
		}
		
	}
	/**
     * @description 分类删除
     * @author jachin  2020-08-05
     */
	public function cateDel(Request $request){
		$id=$request->param('id');
		$status['status']=0;
		if(empty($id)){
			$status['msg']='参数错误';
			return json($status);
		}
		$cate=Cate::get($id);
		if(!$cate){
			$status['msg']='参数错误';
			return json($status);
		}
		
		$res=Cate::where('id', $id)->update(['status' => 0,'delete_time'=>time()]);
		if($res){
			get_log('delete',\session('uid'),'刪除了id为'.$id.'的文章分类');
				$status=[
					'status'=>1,
					'msg'=>'刪除成功'
				];
			}else{
				$status['msg']='刪除失败';
			}
			return json($status);
	}
	/**
     * @description 分类编辑
     * @author jachin  2020-08-05
     */
	public function cateEdit(Request $request){
		if(Request()->isPost()){
			$status['status']=0;
			$data=input('post.');
			if(empty($data['id'])){
				$status['msg']='参数错误';
				return json($status);
			}
			$id=$data['id'];
			$cate=Cate::where('id',$id)->field('name,sort')->find();
			if(!$cate){
				$status['msg']='参数错误';
				return json($status);
			}
			$map= array();
			if($cate['name']!==$data['name']){
				$map['name']=$data['name'];
			}
			if($cate['sort']!==$data['sort']){
				$map['sort']=$data['sort'];
			}
			if (empty($map)) {
				$status['msg']='您未修改数据';
				return json($status);
			}
			$res=Cate::where('id',$id)->update($map);
			if($res){
				get_log('update',\session('uid'),'修改了id为'.$id.'的文章分类');
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
				return $this->error('参数错误','article/cate','',2);
			}
			$cate=Cate::where('id',$id)->field('id,name,sort')->find();
			if(!$cate){
				return $this->error('参数错误','article/cate','',2);
			}
			return view('cateEdit',['cate'=>$cate]);
		}
	}

	/**
     * @description 文章列表
     * @author jachin  2020-08-05
     */
	public function index(){
		$title=input('get.title');
		$type=input('get.type');
		$status=input('get.status');
		$pageParam    = ['query' =>[]];
		if($title){
			$pageParam['query']['title'] = $title;
			
			$mapTitle=[['title','like','%'.$title.'%']];
		}else{
			$mapTitle=[];
		}
		if($type){
			$pageParam['query']['type'] = $type;
			
			$mapType=[['type','=',$type]];
		}else{
			$mapType=[];
		}
		if($status){
			$pageParam['query']['status'] = $status;
			
			$mapStatus=[['status','=',$status]];
		}else{
			$mapStatus=[['status','>',0]];
		}
		if(session('uid')!=1){
			$mapUid=[['uid',session('uid')]];
		}else{
			$mapUid=[];
		}
		$list=ArticleModel::with(['cate','admin'])->where($mapTitle)
			->where($mapType)->where($mapUid)->where($mapStatus)
			->order('create_time desc')
			->paginate(10,false,$pageParam);
		$page=$list->render();
		return view('index',['title'=>$title,'list'=>$list,'page'=>$page,'status'=>$status,'type'=>$type]);
	}
	/**
     * @description 文章添加
     * @author jachin  2020-08-05
     */
	public function add(){
		if(Request()->isPost()){
			$status['status']=0;
			$data=input('post.');

			$validate=new  ArticleValidate();
			if(!$validate->scene('add')->check($data)){
				$status['msg']=$validate->getError();
				return json($status);
			}
			$file = request()->file('pic');
			if(empty($file)){
				$status['msg']='请上传图片';
				return json($status);
			}
		    // 移动到框架应用根目录/uploads/ 目录下
		    $info = $file->validate(['size'=>10*1024*1024,'ext'=>'jpg,png,gif'])->rule('date')->move( './uploads');
		    if($info){
		        $data['pic']=$info->getSaveName();
		    }else{
		        // 上传失败获取错误信息
		        $status['msg']=$file->getError();
				return json($status);
		    }
		    $data['create_time']=time();
		    $data['update_time']=time();
		    $data['uid']=session('uid');
		    $res=ArticleModel::create($data);
		    if($res){
				$msg['msg']='添加成功';
				$msg['status']=1;
				
			}else{
				$msg['msg']='添加失败';
				$msg['status']=0;
			}
			return json($msg);

		}else{
			$cate=Cate::where('status',1)->field('name,id')->select();
			return view('add',['cate'=>$cate]);
		}
	}
	/**
     * @description 文章编辑
     * @author jachin  2020-08-05
     */
	public function edit(Request $request){
		if(Request()->isPost()){

		}else{
			$id=$request->param('id');
			if(empty($id)){
				return $this->error('参数错误','article/index','',2);
			}
			$res=ArticleModel::with(['cate','admin'])->where('id',$id)->find();
			$cate=Cate::where('status',1)->select();
			if(!$res){
				return $this->error('参数错误','article/index','',2);
			}
			return view('edit',['list'=>$res,'cate'=>$cate]);
		
		}
	}
	/**
     * @description 文章删除
     * @author jachin  2020-08-05
     */
	public function del(Request $request){
		$data['status']=0;
		$id=intval($request->param('id'));
		if(empty($id)){
			$data['msg']='参数错误';
			return json($status);
		}
		$article=ArticleModel::where('id',$id)->find();
		$article->status=0;
		$article->delete_time=time();
		$res=$article->save();
		if($res){
			get_log('delete',\session('uid'),'删除了id为'.$id.'的账号信息');
			$data['status'] = 1;
			$data['msg']    = '删除成功';
			
		}else{
			$data['msg']    = '删除失败';
		}
		return json($data);
	}
	/**
     * @description 文章详情
     * @author jachin  2020-08-05
     */
	public function detail(Request $request){
		$id=Request()->param('id');
		if(empty($id)){
			return  $this->error('参数错误','article/index','',2);
		}
		$res=ArticleModel::with(['cate','admin'])->where('id',$id)->find();
		if($res){
			return view('detail',['list'=>$res]);
		}else{
			return  $this->error('参数错误','article/index','',2);
		}
	}
	/**
     * @description 批量删除
     * @author jachin  2020-08-07
     */
	public function delAll(Request $request){
		$data['status']=0;
		$ids=$request->param('check_val');
		// var_dump($ids);exit;
		if(!$ids){
			$data['msg']='你未选择任何选项，请选择后再提交！';
			return json($data);
		}
		
		$map=array();
		foreach ($ids as $key => $value) {
			$map[$key]=['id'=>$value,'status'=>0];
		}
		$article=new ArticleModel();
		$res=$article->saveAll($map);
		if($res){
			get_log('deletes',\session('uid'),'批量删除了id为'.implode(',',$ids).'的账号信息');
			$data['status'] = 1;
			$data['msg']    = '删除成功';
		}else{
			$data['msg']    = '删除失败';
		}
		return json($data);
	}
	/**
     * @description 文章置顶
     * @author jachin  2020-08-05
     */
	public function stick(){

	}
	/**
     * @description 文章显示
     * @author jachin  2020-08-05
     */
	public function articleShow(Request $request){
		$data['status']=0;
        $id= intval($request->param('id'));
        $method=$request->param('method');
        if(empty($id)||empty($method)){
        	$data['msg']='参数错误';
        	return json($data);
        }
		$article=ArticleModel::where('id',$id)->find();
		if(!$article){
			$data['msg']='参数错误';
			return json($data);
		}
		if($method==='start'){
			$article->status =2;
		}else if($method==='stop'){
			$article->status =1;
		}else{
			$data['msg']='参数错误';
			return json($data);
		}
		$res=$article->save();
		if($res){
			if($method==='start'){
				$msg='显示成功';
			}else{
				$msg='隐藏成功';
			}
			$data=array(
				'status' => 1,
				'msg'    => $msg
			);
		}else{
			if($method==='start'){
				$msg = '显示失败';
			}else{
				$msg = '隐藏失败';
			}
			$data['msg'] = $msg;
		}
		return json($data);
	}
	/**
     * @description 评论管理
     * @author jachin  2020-08-05
     */
	public function comment(){
		
		return view('comment');

	}
	/**
     * @description 评论删除
     * @author jachin  2020-08-05
     */
	public function commentDel(){

	}

	/**
     * @description 评论显示
     * @author jachin  2020-08-05
     */
	public function commentShow(){

	}

	/**
     * @description 文章点赞统计
     * @author jachin  2020-08-05
     */
	public function easyLike(){
		return view('easyLike');

	}
}