<?php
namespace app\admin\controller;

use app\admin\validate\SmsSendValidate;
use think\Request;

class Demo extends Base
{
    protected $beforeActionList = [ 
        // must use lowerCase try find answer with doc
        // 'shouldCheckCsrfToken' => [
        //     'only' => 'smsSend'
        // ]
    ];

    public function smsSend(Request $request, SmsSendValidate $validate)
    {
        if(!$validate->check($request->post())){
            return $validate->getError();
        }
        if (request()->isAjax()) {
            $param            = input('param.');
            $mobile           = $param['mobile']; //手机号
            $tplCode          = $param['tplcode']; //模板ID
            $tplParam['code'] = $param['code']; //验证码
            $msgStatus        = sendMsg($mobile, $tplCode, $tplParam);
            return json(['code' => $msgStatus['Code'], 'msg' => $msgStatus['Message']]);
        }
    }

    public function sms(){
        return view();
    }

}
