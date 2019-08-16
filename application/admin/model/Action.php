<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------
namespace app\admin\model;

use think\Model;


/**
 * 行为模型
 * @author jachin <jachin@qq.com>
 */
class Action extends Model{

	protected $autoWriteTimestamp=true;	
	/**
     * @description  关联log表 action（1）-log（n） 一对多关系
     * @return array 返回查询到的数据
     * @author jachin  2019-08-16
     */
	public function log(){
      return $this->hasMany('Log');
    }
}