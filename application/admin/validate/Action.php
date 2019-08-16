<?php

// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\validate;

use think\Validate;
/**
 * 行为验证器
 * @author jachin <jachin@qq.com>
 */
class Action extends Validate{
	/**
     * @description 验证规则
     * @author jachin  2019-08-15
     */
	protected $rule =[
		'actionName'=>'require|unique:action',
		'actionTitle'=>'require',
		'remark'=>'require',
	];
	/**
     * @description 错误信息
     * @author jachin  2019-08-15
     */
	protected $message =[
		'actionName.require'=>'行为标识必须填写',
		'actionName.unique'=>'该行为标识已存在',
		'actionTitle.unique'=>'行为名称必须填写',
		'remark.unique'=>'行为描述必须填写',
	];
	
}