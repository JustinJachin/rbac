<?php

// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\validate;
use think\Validate;

/**
 * 管理员验证器
 * @author jachin <jachin@qq.com>
 */
class Permission extends Validate{
	/**
     * @description 验证规则
     * @author jachin  2019-08-08
     */
	protected $rule=[
		'title'=>'require',
		// 'name'=>'require|regex:/\w+\\\\/\w+/',
		'name'=>'require|regex:[\w\\\\\/\w]+',
		'module_id'=>'require',
		'parent_id'=>'require',
		'display_menu'=>'require',

	];
	protected $message=[
		'title.require'=>'名字必须填写',
		'name.require'=>'路由必须填写',
		'name.regex'=>'路由不合规定',
		'module_id.require'=>'模块必须选择',
		'parent_id.require'=>'请选择父级',
		'display_menu.require'=>'请选择是否为导航',
	];

}

