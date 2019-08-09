<?php

// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\model;


use think\Model;
use think\Session;
use think\facade\Validate;

/**
 * 图标模型
 * @author jachin <jachin@qq.com>
 */
class Icon extends Model
{
    /**
     * @description  关联permission表 icon（1）-permission（n）一对多关系
     * @return array 返回查询到的数据
     * @author jachin  2019-08-08
     */
	public function permission(){
		return $this->hasMany('Permission','icon');
	}
    

}