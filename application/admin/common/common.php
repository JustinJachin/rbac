<?php

function  del($id,$model){
	// var_dump($model);exit;
	if(empty($id)){
		$status=[
			'status'=>0,
			'msg'=>'你尚未选择删除的选项，请重新选择',
		];
		return json($status);
	}
	
	// $log=$model::find($id);
	$log=model($model)->del();
	var_dump($log);exit;
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
	return $status;	
}