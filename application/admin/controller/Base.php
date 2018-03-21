<?php

namespace app\admin\controller;

use app\admin\model\Admin;
use think\Controller;
use think\facade\Hook;

class Base extends Controller
{

    public function __construct()
    {
        
        parent::__construct();

        Hook::listen('auth_check');

        $this->assign([

            'menu'     => session('admin')->getMenu(),

            'username' => session('username'),

            'portrait' => session('portrait'),

            'rolename' => session('rolename'),

        ]);
    }
}
