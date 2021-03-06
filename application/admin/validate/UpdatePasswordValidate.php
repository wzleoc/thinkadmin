<?php
namespace app\admin\validate;
use think\Validate;

class UpdatePasswordValidate extends Validate
{
    protected $rule = [
        'old_password' => 'require|min:6',
        'password'     => 'require|min:6',
    ];

    protected $message = [
        'old_password.require' => '旧密码不能为空',
        'old_password.min'      => '旧密码不小于六位',
        'password.require'     => '密码不能为空',
        'password.min'          => '密码不能小于六位'
    ];

}
