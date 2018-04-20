<?php
namespace app\admin\validate;

use think\Validate;

class RoleStoreValidate extends Validate
{
    protected $rule = [
        'role_name'     => 'require|unique:role',
    ];
    protected $message = [
        'role_name.require'     => '角色名必须填写',
        'role_name.unique'      => '角色已存在',
    ];
}