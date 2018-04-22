<?php
namespace app\lib\exception;

use think\exception\Handle;

use think\exception\HttpException;

class ExceptionHandler extends Handle
{
    public function render(\Exception $e)
    {
        if(config()['app']['app_debug']){
            return parent::render($e);
        }else{
            if ($e instanceof BaseException) {
                return json([
                    'msg'  => $e->msg,
                    'code' => $e->code,
                ], $e->status);
            } else {
                if(request()->header('X-Requested-With') == 'XMLHttpRequest') {
                    return json([
                        'msg'  => '请求路径不存在',
                        'code' => -1,
                    ], 400);
                } 
                return redirect('admin/index/httpNotFound');
            }
        }    
    }
}
