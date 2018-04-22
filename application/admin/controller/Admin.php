<?php

namespace app\admin\controller;

use app\admin\model\Admin as AdminModel;
use app\admin\model\Role;
use app\admin\validate\AdminStoreValidate;
use app\admin\validate\AdminUpdateValidate;
use app\lib\exception\BaseException;
use think\Request;
use think\Container;

class Admin extends Base
{
    protected $beforeActionList = [ 
        //小写方法名
        'shouldCheckCsrfToken' => [
            'only' => 'store,update,delete,status,deletemany'
        ]
    ];

    public function index(Request $request)
    {
        return view('index', [
            'key' => input('post.key', ''), 
            'p' => input('p', 1), 
            'list_rows' => $this->limits
        ]);
    }

    public function getData(Request $request)
    {
        $limits  = $request->get('limit');
        $nowPage = $request->get('page');
        if (!$key = $request->get('key')) {
            $lists = AdminModel::where('id','<>',1)->with('role')->select();
        } else {
            $lists = AdminModel::where('id','<>',1)->where('name', 'like', '%' . $key . '%')->with('role')->select();
        }
        $count   = count($lists);
        $allPage = (int) ceil($count / $limits);
        $data    = page($nowPage, $limits, $allPage, $lists);
        return json(["code" => 0, "msg" => "", "count" => $count, 'data' => $data]);
    }

    public function create()
    {
        return view('create', ['roles' => Role::all()]);
    }

    public function store(Request $request, AdminStoreValidate $validate)
    {
        if (!$validate->check($request->post())) {
            return json(['code' => 0, 'msg' => $validate->getError()]);
        }
        if (AdminModel::create($request->post())) {
            return json(['code' => 1, 'msg' => '添加用户成功']);
        }
        return json(['code' => 0 , 'msg' => '添加用户失败']);
    }
    public function edit($id, $page)
    {
        return view('edit', [
            'admin' => AdminModel::where('id', $id)->with('role')->find(),
            'roles' => Role::all(),
            'page'  => $page,
        ]);
    }

    public function update(Request $request, AdminUpdateValidate $validate)
    {
        $data = $request->post('password') ? $request->post() : $request->except('password');
        if (!$validate->check($request->post())) {
            return json(['code' => 0, 'msg' => $validate->getError()]);
        }
        if (false !== AdminModel::update($data)) {
            return json(['code' => 1, 'msg' => '编辑成功']);
        }
        return json(['code' => 0 , 'msg' => '编辑失败']);
    }

    public function delete($id)
    {
        if (AdminModel::destroy($id)) {
            return json(['code' => 1, 'msg' => '删除成功', 'count' =>  AdminModel::count()]);
        }
        return json(['code' => 0 , 'msg' => '删除失败','count' => AdminModel::count()]);
    }
    public function deleteMany(Request $request)
    {
        $ids  = [];
        foreach ($request->post('arrIds/a') as $key => $v) {
            $ids[] = (int) $v;
        }
        if (AdminModel::destroy($ids)) {
            return json(['code' => 1, 'msg' => '删除成功', 'count' => AdminModel::count()]);
        }
        return json(['code' => 0 , 'msg' => '删除失败','count' => AdminModel::count()]);
    }
    
    public function status(Request $request)
    {
        $admin = AdminModel::get($request->get('id'));
        if ($admin->status == 1) {
            $admin->status = 0;
            $admin->save();
            return json(['code' => 1, 'msg' => '已禁用']);
        }
        $admin->status = 1;
        $admin->save();
        return json(['code' => 0, 'msg' => '已开启']);
    }

}
