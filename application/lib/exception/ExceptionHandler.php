<?php
namespace app\lib\exception;

use think\exception\Handle;

class ExceptionHandler extends Handle
{
    public function render(\Exception $e)
    {
        if ($e instanceof BaseException) {
            return json([
                'msg'  => $e->msg,
                'code' => $e->code,
            ], $e->status);
        } else {
            if (config()['app']['app_debug']) {
                return parent::render($e);
            } else {
                return json([
                    'msg'  => '错误啦不告诉你',
                    'code' => 0,
                ], 500);
            }
        }
    }
}
