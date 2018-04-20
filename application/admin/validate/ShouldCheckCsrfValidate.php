<?php
namespace app\admin\validate;

use think\Validate;

class ShouldCheckCsrfValidate extends Validate
{
    protected $rule = [
        '__token__' => 'require|token',
    ];
    protected $message = [
        '__token__.require' => '非法请求123',
        '__token__.token'   => '非法请求234',
    ];
}
