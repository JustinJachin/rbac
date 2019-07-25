<?php


namespace app\admin\validate;


use think\Validate;

class LoginValidate extends Validate
{
    protected $rule=[
        'email'=>'require',
        'password'=>'require',
        'code'=>'require',
    ];
    protected $message=[
      'email.require'=>'用户名或者邮箱必须填写',
      'password.require'=>'密码不能为空',
      'code.require'=>'验证码不能为空'
    ];
}