<?php
namespace app\admin\behavior;

use app\admin\model\Role;
use think\Controller;

class Auth extends Controller
{
    public function authCheck()
    {
        if (!session('admin') || session('admin.status') == 0) {
            $this->redirect('login/index');
        }
        //$auth = new \com\Auth();
        $module     = strtolower(request()->module());
        $controller = strtolower(request()->controller());
        $action     = strtolower(request()->action());
        $url        = $module . "/" . $controller . "/" . $action;
        //跳过检测以及主页权限
        if (session('admin.id') != 1) {
            if (!in_array($url, 
                [
                    'admin/index/index', 
                    'admin/index/indexpage', 
                    'admin/upload/upload', 
                    'admin/upload/uploadqiniu',    
                ])) {
                if (!$this->_urlCheck($url)) {
                    $this->redirect('admin/index/index');
                }
            }
        }
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
            if ($url == $value['name']) {
                $access = true;
                break;
            }
        }
        return $access;
    }
}
