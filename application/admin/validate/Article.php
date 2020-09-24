<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\validate;
use think\Validate;
/**
 * 文章验证器
 * @author jachin <jachin@qq.com>
 */
class Article extends Validate
{
	/**
     * @description 验证规则
     * @author jachin  2019-08-15
     */
	protected $rule =[
		'title'=>'require',
		'cate_id'=>'require',
		'content'=>'require',
		'type'=>'require',
	];
	/**
     * @description 错误信息
     * @author jachin  2019-08-15
     */
	protected $message =[
		'title.require'=>'文章标题必须填写',
		'cate_id.require'=>'文章分类必须选择',
		'content.require'=>'文章内容必须填写',
		'type.require'=>'文章类型必须选择',
	];
	protected $scene=[
		'add'=>['title','cate_id','content','type'],
		// 'edit'=>['actionName'],
	];
}