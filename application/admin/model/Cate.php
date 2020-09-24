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

class Cate extends Model{


    protected $pk = 'id';
	/**
     * @description  关联cate表 article（1）-cate（1） 一对一关系
     * @return array 返回查询到的数据
     * @author jachin  2020-08-7
     */
	public function article(){
		return $this->hasOne('Article','cate_id','id');
	}

}