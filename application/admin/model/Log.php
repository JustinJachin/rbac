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

class Log extends Model{

	/**
     * @description  关联log表 admin（1）-log（n） 一对多关系
     * @return array 返回查询到的数据
     * @author jachin  2019-08-16
     */
	public function admin(){
		return $this->belongsTo('Admin');
	}
	/**
     * @description  关联log表 action（1）-log（n） 一对多关系
     * @return array 返回查询到的数据
     * @author jachin  2019-08-16
     */
	public function action(){
		return $this->belongsTo('Action');
	}

}