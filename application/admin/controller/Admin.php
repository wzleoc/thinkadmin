<?php

namespace app\admin\controller;

use app\admin\model\Admin as AdminModel;
use app\admin\model\Config;
use app\admin\model\Role;
use app\admin\validate\AdminStoreValidate;
use app\admin\validate\AdminUpdateValidate;
use think\Request;

class Admin extends Base
{
    public function index(Request $request)
    {
        $list_rows = Config::where(['name' => 'list_rows'])->value('value');
        $p         = input('p', 1);
        $key       = input('post.key', '');
        return view('index', ['key' => $key, 'p' => $p, 'list_rows' => $list_rows]);
    }

    public function getData(Request $request)
    {

        $limits  = $request->get('limit');
        $nowPage = $request->get('page');
        if ($request->get('key') == '') {
            $lists = AdminModel::with('role')->select();
        } else {
            $key   = $request->get('key');
            $lists = AdminModel::where('name', 'like', '%' . $key . '%')->with('role')->select();
        }
        $count   = count($lists);
        $allPage = (int) ceil($count / $limits);
        $data    = page($nowPage, $limits, $allPage, $lists);
        return ["code" => 0, "msg" => "", "count" => $count, 'data' => $data];
    }

    public function create()
    {
        $roles = Role::all();
        return view('create', ['roles' => $roles]);
    }

    public function store(Request $request, AdminStoreValidate $validate)
    {
        if (!$validate->check($request->post())) {
            return ['code' => 0, 'msg' => $validate->getError()];
        }
        if (AdminModel::create($request->post())) {
            return ['code' => 1, 'msg' => '添加用户成功'];
        }
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
        if (!$validate->check($data)) {
            return ['code' => 0, 'msg' => $validate->getError()];
        }
        if (AdminModel::update($data)) {
            return ['code' => 1, 'msg' => '编辑成功'];
        }
    }

    public function delete($id)
    {
        if (AdminModel::destroy($id)) {
            $count = AdminModel::count();
            return ['code' => 1, 'msg' => '删除成功', 'count' => $count];
        }
    }
    public function deleteMany(Request $request)
    {
        $data = $request->post();
        $ids  = [];
        foreach ($data['arrIds'] as $key => $v) {
            $ids[] = (int) $v;
        }
        if (AdminModel::destroy($ids)) {
            $count = AdminModel::count();
            return ['code' => 1, 'msg' => '删除成功', 'count' => $count];
        }
    }
    public function status(Request $request)
    {
        $id    = $request->get('id');
        $admin = AdminModel::get($id);
        if ($admin->status == 1) {
            $admin->status = 0;
            $admin->save();
            return ['code' => 1, 'msg' => '已禁用'];
        }
        $admin->status = 1;
        $admin->save();
        return ['code' => 0, 'msg' => '已开启'];
    }

}
