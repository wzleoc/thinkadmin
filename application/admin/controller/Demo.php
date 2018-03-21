<?php
namespace app\admin\controller;

class Demo extends Base
{
    public function sms(){

        if(request()->isAjax()){
            $param = input('param.');
            $mobile = $param['mobile'];     //手机号
            $tplCode = $param['tplcode'];   //模板ID
            $tplParam['code'] = $param['code'];//验证码
            $msgStatus = sendMsg($mobile,$tplCode,$tplParam);
            return json(['code' => $msgStatus['Code'], 'msg' => $msgStatus['Message']]);
        }
        return $this->fetch();      
    }

}