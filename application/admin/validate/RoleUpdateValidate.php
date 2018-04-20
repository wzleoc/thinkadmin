<?php
namespace app\admin\validate;

use think\Validate;

class RoleUpdateValidate extends Validate
{
    protected $rule = [
        'role_name'     => 'require|unique:role,role_name',
    ];
    protected $message = [
        'role_name.require'     => '角色名必须填写',
        'role_name.unique'      => '角色已存在',
    ];
}