<?php

namespace app\admin\controller;

use app\admin\model\Admin;
use app\admin\model\Role as RoleModel;
use app\admin\validate\RoleStoreValidate;
use app\admin\validate\RoleUpdateValidate;
use app\admin\validate\RoleDeleteValidate;
use think\Request;

class Role extends Base
{
    protected $beforeActionList = [ 
        'shouldCheckCsrfToken' => [
            'only' => 'store,update,delete,postaccessdata'
        ]
    ]; 
    
    public function index(Request $request)
    {
        return view('index', [
            'key' => input('key', ''), 
            'limits' => $this->limits,
            'p'   => input('p',1),
        ]);
    }

    public function getRoleData(Request $request)
    {
        $nowPage = $request->post('page') ?: 1;
        $lists   = $request->post('key')
        ? RoleModel::where('role_name', 'like', '%' . $request->post('key') . '%')->select()
        : RoleModel::all();
        $count   = count($lists);
        $allPage = (int) ceil($count / $this->limits);
        $data    = page($nowPage, $this->limits, $allPage, $lists);
        return json(['data' => $data, 'count' => $count , 'code' => 1]);
    }

    public function create()
    {
        return view();
    }

    public function store(Request $request, RoleStoreValidate $validate)
    {
        if (!$validate->check($request->post())) {
            return json(['code' => 0, 'msg' => $validate->getError()]);
        }
        if (RoleModel::create($request->post())) {
            return json(['code' => 1, 'msg' => '添加角色成功']);
        } else {
            return json(['code' => 0, 'msg' => '添加角色失败']);
        }
    }

    public function edit(Request $request)
    {
        return view('edit', [
            'role' => RoleModel::get(input('id')),
            'p'  => input('p')
        ]);
    }

    public function update(Request $request, RoleUpdateValidate $validate)
    {
        if (!$validate->check($request->post())) {
            return json(['code' => 0, 'msg' => $validate->getError()]);
        }
        if (false !== RoleModel::update($request->post())) {
            return json(['code' => 1, 'msg' => '更新角色成功']);
        }else{
            return json(['code' => 0 , 'msg' => '更新角色失败']);
        }
    }

    public function delete(RoleDeleteValidate $validate ,Request $request)
    {
        if(!$validate->check($request->get())){
            return json(['code' => 0 , 'msg' => $validate->getError()]);
        }
        if($role = RoleModel::where(['id' => $request->get('id')])->find()){
            $role->nodes()->detach();
        }
        if (RoleModel::destroy($request->get('id'))) {
            if (false !== Admin::where(['role_id' => $request->get('id')])->update(['role_id' => 0])) {
                return json([
                    'code' => 1, 
                    'msg' => '删除角色成功',
                    'allPage' => (int)ceil(RoleModel::count() / $this->limits)
                ]);
            }else{
                return json([
                    'code' => 0 , 
                    'msg' => '删除角色失败',
                    'allPage' => (int)ceil(RoleModel::count() / $this->limits)
                ]);
            }
        }else{
            return json([
                'code' => 0 , 
                'msg' => '删除角色失败',
                'allPage' => (int)ceil(RoleModel::count() / $this->limits)
            ]);
        }
        return json([
            'code' => 0, 
            'msg' => '删除角色失败',
            'allPage' => (int)ceil(RoleModel::count() / $this->limits)
        ]);
    }
    
    public function getAccessData(Request $request)
    {
        if ('get' == $request->get('type')) {
            return json([
                'code' => 1, 
                'data' => RoleModel::get($request->param('id'))->getNodeInfo(), 
                'msg' => 'succeess'
            ]);
        } 
        throw new BaseException();
    }
    // 差距在这些地方 laravel的sync
    public function postAccessData(Request $request){
        $role = RoleModel::get($request->param('id'));
        if ('give' == $request->post('type')) {
            $role->nodes()->detach();
            if ($nodeArr = $request->post('nodeArr/a')) {
                foreach ($nodeArr as $k => $v) {
                    $nodeArr[$k] = (int) $v;
                }
                $role->nodes()->attach($nodeArr);
            }
            return json([
                'code' => 1, 
                'data' => $role->getNodeInfo(), 
                'msg' => '分配权限成功'
            ]);
        }
        throw new BaseException();
    }
}
