<?php
namespace app\admin\validate;

use think\Validate;

class LoginValidate extends Validate
{
    protected $rule = [
        'username' => 'require|min:5',
        'password' => 'require|min:6',
    ];

    protected $message = [
        'username.require' => '用户名必须',
        'username.min'     => '用户名不能小于5个字符',
        'password'         => '密码必须',
        'password.min'     => '密码不得小于6个字符',
    ];

}
