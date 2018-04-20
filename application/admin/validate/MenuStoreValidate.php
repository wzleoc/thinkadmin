<?php
namespace app\admin\validate;

use think\Validate;

class MenuStoreValidate extends Validate
{
    protected $rule = [
        'pid'     => 'require',
        'title'   => 'require',
        'name'    => 'require',
        'sort'    => 'require',
        'status'  => 'require'
    ];
    protected $message = [
        'pid.require'     => '参数PID必须',
        'title.require'   => '标题必须',
        'name.require'    => '模块/控制器/方法必须填写',
        'sort.require'    => '排序必须',
        'status.require'  => '状态必须'
    ];
}