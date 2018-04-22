<?php

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Admin;
use app\admin\model\Config;
use app\admin\model\Role;
use app\lib\exception\BaseException;
use think\Request;
use think\facade\Log;

class Base extends Controller
{
    protected $limits;

    public function initialize()
    {
        $this->limits = Config::where(['name' => 'list_rows'])->value('value');
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
            return true;
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
        if(input('token') != session('csrftoken')){
            if('http://' . request()->header('host') != request()->header('origin') && 'https://' . request()->header('host') != request()->header('origin')){
                Log::write([
                    'header' => request()->header(),
                    'ip'     => request()->ip()
                ],'Csrf');
                throw new BaseException('非法跨域请求攻击！我们不会坐以待毙！');
                // DDOS反击？
            }else{
                if(config()['app']['app_debug']){
                    throw new BaseException('校验token不通过');    
                }else{
                    throw new BaseException('请关闭调试模式');
                }    
            }    
        }
    }




}
