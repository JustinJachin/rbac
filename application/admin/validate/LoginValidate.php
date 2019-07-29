<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------


namespace app\admin\validate;


use think\Validate;
/**
 * 登录验证器
 * @author jachin <jachin@qq.com>
 */

class LoginValidate extends Validate
{
  /**
     * @description 验证规则
     * @author jachin  2019-07-29
     */
    protected $rule=[
        'email'=>'require',
        'password'=>'require',
        'code'=>'require',
    ];
    /**
     * @description 错误信息
     * @author jachin  2019-07-29
     */
    protected $message=[
      'email.require'=>'用户名或者邮箱必须填写',
      'password.require'=>'密码不能为空',
      'code.require'=>'验证码不能为空'
    ];
}