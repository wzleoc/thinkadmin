<?php

namespace app\admin\controller;

use app\admin\model\Admin;
use app\admin\validate\LoginValidate;
use think\Controller;
use think\Request;
use app\admin\validate\ShouldCheckCsrfValidate;
use app\lib\exception\BaseException;

class Login extends Controller
{
    protected $beforeActionList = [ 
        // 'shouldCheckCsrfToken' => [
        //     'only' => 'dologin,logout'
        // ]
    ];

    public function index()
    {
        return view('index', ['verify_type' => config('admin.verify_type')]);
    }

    public function doLogin(Request $request , LoginValidate $validate)
    {
        if (!$validate->check($request->post())) {
            return ['code' => 0, 'msg' => $validate->getError()];
        }
        return json(Admin::checkLogin($request));
        // return json(Admin::checkLogin($request))->header('token',session('csrftoken'));
    }

    public function logout()
    {
        session(null);
        return redirect('admin/login/index');
    }

    protected function shouldCheckCsrfToken()
    {
        $validate = new ShouldCheckCsrfValidate();
        if(!$validate->check(request()->param())){
            throw new BaseException();                              
        }
    }
    // private function _checkVerifyCode(){

    // }
}
