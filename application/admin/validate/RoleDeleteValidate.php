<?php
namespace app\admin\validate;

use think\Validate;

class RoleDeleteValidate extends Validate
{
    protected $rule = [
        'id'     => 'require',
    ];
    protected $message = [
        'id.require'     => 'ID必传'
    ];
}