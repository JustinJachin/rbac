<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\validate;

use think\Validate;


/**
 * 角色验证器
 * @author jachin <jachin@qq.com>
 */
class Role extends Validate{
	protected $rule=[
		'name|名字'=>'require|unique:role|max:20',
		'description'=>'require|unique:role',
	];
	protected $message=[
		'name.require'=>'名字必须填写！',
		'name.unique'=>'该名字已存在',
		'name.max'=>'名字最长不超过20位',
		'description.require'=>'描述必须填写',
		'description.unique'=>'描述已存在',

	];
	protected $scene=[
		'add'=>['name','description'],
		'editName'=>['name.unique','name.max'],
		'editDesc'=>['description.unique']
	];
}