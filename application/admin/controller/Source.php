<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Source as SourceModel;
class Source extends Base{
    public function index(){
        if(request()->isPost()){
            $data=input('post.');
            var_dump($data);exit;
        }else{
            $list=SourceModel::select();
            $this->assign('list',$list);
            return view(); 
        }
        
    }
}