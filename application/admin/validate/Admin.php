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

class Admin extends Validate{
	/**
     * @description 验证规则
     * @author jachin  2019-07-29
     */
	protected $rule=[
		'name'=>'require|max:25|unique:admin',
		'sex'=>'require',
		'password'=>'require|confirm|regex:^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$',
		'email'=>'require|email|unique:admin',
	];
	/**
     * @description 错误信息
     * @author jachin  2019-07-29
     */
	protected $message=[
		'name.require'=>'名字必须填写',
		'name.unique'=>'名字用户名已注册',
		'name.max'=>'名字长度最大为20位',
		'sex.require'=>'性别必须选择',
		'password.require'=>'密码必须填写',
		'password.regex'=>'密码必须由数字和字母组成，且要8-20位之前',
		'password.confirm'=>'密码不一致',
		'email.require'=>'邮箱必须填写',
		'email.email'=>'邮箱格式错误',
		'eamil.unique'=>'邮箱已注册',
	];
}