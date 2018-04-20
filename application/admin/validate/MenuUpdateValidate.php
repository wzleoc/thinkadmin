<?php
namespace app\admin\validate;

use think\Validate;

class MenuUpdateValidate extends Validate
{
    protected $rule = [
        'id'     => 'require|integer',
        'title'  => 'require',
        'name'   => 'require',
        'sort'   => 'require',
        'status' => 'require',
    ];
    protected $message = [
        'id.require'     => 'ID比传',
        'id.integer'     => 'ID必须为整形',
        'title.require'  => '标题必须',
        'name.require'   => '模块/控制器/方法必须填写',
        'sort.require'   => '排序必须',
        'status.require' => '状态必须',
    ];
}
