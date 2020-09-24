<?php

// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\model;


use think\Model;
use think\Session;
use think\facade\Validate;
use think\facade\Request;

/**
 * 模块模型
 * @author jachin <jachin@qq.com>
 */
class Module extends Model
{
	/**
     * @description  关联permission表 module（1）-permission（n）一对多关系
     * @return array 返回查询到的数据
     * @author jachin  2019-08-08
     */
	public function perssion(){
		return $this->hasMany('Permission');
	}

    /**
     * @description  获取当前模块
     * @return array 返回模块id
     * @author jachin  2019-08-08
     */
	public function getModuleId(){
		$model=Request::module();

        $module_id=$this::where('name',$model)->field('name,id')->find();
        return $module_id['id'];
	}
}