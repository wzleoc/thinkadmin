<?php
namespace app\admin\validate;

use think\Validate;

class SmsSendValidate extends Validate
{
    protected $rule = [
        'mobile'     => 'require|mobile',
        'tplcode'    => 'require',
        'code'       => 'require'
    ];
    protected $message = [
        'mobile.require'     => '必须',
        'mobile.mobile'      => '手机号码有误',
        'tplcode.require'    => '模板ID必传',
        'code.require'       => '验证码必传'
    ];
}