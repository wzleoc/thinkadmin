<?php
namespace app\admin\controller;

use app\admin\model\Admin;
use app\admin\validate\UpdatePasswordValidate;
use think\Request;
use app\admin\model\Config;
class Index extends Base
{

    public function index()
    {
        return view('/index', [
            'admin' => session('admin'),
            'web_site_copy' => Config::where(['name' => 'web_site_copy'])->value('value')
        ]);
    }

    public function indexPage()
    {
        $info = [
            'web_server' => $_SERVER['SERVER_SOFTWARE'],
            'onload'     => ini_get('upload_max_filesize'),
            'phpversion' => phpversion(),
        ];
        return view('index', [
            'info' => $info,
        ]);
    }

    public function editpwd()
    {
        return view();
    }

    public function updatepwd(Request $request, UpdatePasswordValidate $validate)
    {
        if ($validate->check($request->post())) {
            return ['code' => 0, 'msg' => $validate->getError()];
        }
        $user = Admin::get(session('admin.id'));
        if (md5(md5($request->post('old_password'))) != $user->password) {
            return ['code' => -1, 'msg' => '旧密码错误'];
        } else {
            $user->password = $request->post('password');
            $user->save();
            return ['code' => 1, 'msg' => '修改成功'];
        }
    }
}
