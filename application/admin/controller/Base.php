<?php

namespace app\admin\controller;

use app\admin\model\Admin;
use app\admin\model\Config;
use app\admin\model\Role;
use think\Controller;
use app\admin\validate\ShouldCheckCsrfValidate;
use app\lib\exception\BaseException;
use think\Request;


class Base extends Controller
{
    protected $limits;

    public function initialize()
    {
        \think\facade\Hook::listen('response_send');
        $this->limits = Config::where(['name' => 'list_rows'])->value('value');
        cookie('token',session('csrftoken'));
        if (!$this->authCheck()) {
            if (request()->isAjax()) {
                https(401);
            }
            $this->redirect('admin/index/indexPage');
        }
        $this->assign([
            'menu'     => session('admin')->getMenu(),
            'username' => session('username'),
            'portrait' => session('portrait'),
            'rolename' => session('rolename'),
        ]);
    }
    private function authCheck()
    {
        $this->shouldCheckCsrfToken();
        if (!session('admin') || session('admin.status') == 0) {
            $this->redirect('login/index');
        }
        $module     = strtolower(request()->module());
        $controller = strtolower(request()->controller());
        $action     = strtolower(request()->action());
        $url        = $module . "/" . $controller . "/" . $action;
        //跳过检测以及主页权限
        if (session('admin.id') != 1) {
            if (!in_array($url,
                [
                    'admin/index/editpwd',
                    'admin/index/updatepwd',
                    'admin/index/index',
                    'admin/index/indexpage',
                    'admin/upload/upload',
                    'admin/upload/uploadqiniu',
                ])) {
                if (!$this->_urlCheck($url)) {
                    return false;
                }
                return true;
            }
        }
        return true;
    }

    private function _urlCheck($url)
    {
        $role   = Role::get(session('admin.role_id'));
        $access = false;
        if (!$role) {
            return false;
        }
        $nodes = $role->nodes()->select();

        foreach ($nodes as $value) {

            if ($url == $value['name'] || in_array($url, config('auth.' . $value['name']) ? config('auth.' . $value['name']) : [])) {
                $access = true;
                break;
            }
        }
        return $access;
    }

    protected function shouldCheckCsrfToken()
    {
        // dump(cookie('token'));
        // dump('我进来了');die;
        // dump(request()->header());die;
        // if(!request()->param('token')){
        //     throw new BaseException('非法请求！！');
        // }
        if(cookie('token') != session('csrftoken')){
            throw new BaseException('非法请求！！');
        }
    }

}
