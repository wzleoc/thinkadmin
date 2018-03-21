<?php

namespace app\admin\controller;

use app\admin\model\Admin;
use app\admin\validate\LoginValidate;
use think\Controller;
use think\Request;

class Login extends Controller
{
    protected $loginValidate;

    public function __construct()
    {
        parent::__construct();
        $this->loginValidate = new LoginValidate();
    }

    public function index()
    {
        return view('index', ['verify_type' => config('admin.verify_type')]);
    }

    public function doLogin(Request $request)
    {
        if (!$this->loginValidate->check($request->post())) {
            return ['code' => 0, 'msg' => $this->loginValidate->getError()];
        }
        return Admin::checkLogin($request);
    }

    public function logout()
    {
        session(null);
        return redirect('admin/login/index');
    }

    // private function _checkVerifyCode(){

    // }
}
