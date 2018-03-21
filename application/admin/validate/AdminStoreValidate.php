<?php
namespace app\admin\validate;

use think\Validate;

class AdminStoreValidate extends Validate
{
	protected $rule = [
		'name' => 'require|min:6|unique:admin',
        'email' => 'require|email|unique:admin',
        'password' => 'require|min:6',
        'avatar'  => 'require',
        'status'  => 'require|integer'
	];
	protected $message = [
		'name.require' => '用户名必须填写',
		'name.min' => '用户名不得小于六个字符',
		'name.unique' => '用户名已存在',
		'email.require' => '邮箱必须填写',
		'email.unique' => '邮箱已存在',
		'password.require' => '密码必须填写',
		'password.min' => '密码不得小于留个字符',
		'avatar.require' => '头像必须上传',
		'status.require' => '状态必须',
		'status.integer' => '状态数据有无'
	];
 
}



?>


