<?php
namespace app\admin\validate;
use think\Validate;

class UpdatePasswordValidate extends Validate
{
    protected $rule = [
        'old_password' => 'required|min:6',
        'password'     => 'required|min:6',
    ];

    protected $message = [
        'old_password.required' => '旧密码不能为空',
        'old_password.min'      => '旧密码不小于六位',
        'password.required'     => '密码不能为空',
        'password.min'          => '密码不能小于六位'
    ];

}
