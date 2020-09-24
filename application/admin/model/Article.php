<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\model;

use think\Model;

/**
 * 日志模型
 * @author jachin <jachin@qq.com>
 */

class Article extends Model{

	/**
     * @description  关联admin表 article（1）-admin（1） 一对一关系
     * @return array 返回查询到的数据
     * @author jachin  2020-08-7
     */
	public function  admin(){
		return $this->belongsTo('Admin','uid','id');
	}
	/**
     * @description  关联cate表 article（1）-cate（1） 一对一关系
     * @return array 返回查询到的数据
     * @author jachin  2020-08-7
     */
	public function  cate(){
		return $this->belongsTo('Cate','cate_id','id');
	}
	/*
     * @description  获取器获取状态，重新赋值
     * @param  int    $value
     * @return string 
     * @author jachin  2020-08-7
     */ 
    public function getStatusAttr($value){
      $status=[1=>'隐藏',2=>'显示'];
      return $status[$value];
    }
    /*
     * @description  获取器获取状态，重新赋值
     * @param  int    $value
     * @return string 
     * @author jachin  2020-08-7
     */ 
    public function getTypeAttr($value){
      $type=[1=>'原创',2=>'转载',3=>'翻译'];
      return $type[$value];
    }
}