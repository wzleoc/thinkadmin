<?php

namespace app\admin\controller;

use app\admin\model\Node;
use app\admin\model\NodeRole;
use app\admin\validate\MenuStoreValidate;
use app\admin\validate\MenuUpdateValidate;
use think\Request;

class Menu extends Base
{
    protected $beforeActionList = [ 
        // must use lowerCase try find answer with doc
        'shouldCheckCsrfToken' => [
            'only' => 'menustore,update,delete,order,status'
        ]
    ];
    public function index()
    {
        $nodes = rule(Node::order('sort')->select());
        return view('index', ['nodes' => $nodes]);
    }

    public function menuStore(Request $request , MenuStoreValidate $validate)
    {
        if(!$validate->check($request->post())){
            return json(['code' => 0 , 'msg' => $validate->getError()]);
        }
        if (is_null($request->post('css'))) {
            $data = $request->except(['css']);
        } else {
            $data = $request->post();
        }
        if (Node::create($data)) {
            return json(['code' => 1, 'msg' => '创建菜单成功']);
        } else {
            return json(['code' => 0, 'msg' => '创建菜单失败']);
        }
    }

    public function edit($id)
    {
        return view('edit', ['menu' => Node::get($id)]);
    }

    public function update(Request $request , MenuUpdateValidate $validate)
    {
        if(!$validate->check($request->post())){
            return json(['code' => 0 , 'msg' => $validate->getError()]);
        }
        if (is_null($request->post('css'))) {
            $data = $request->except(['css']);
        } else {
            $data = $request->post();
        }
        if (false !== Node::update($data)) {
            return json(['code' => 1, 'msg' => '更新成功']);
        }
    }

    public function delete(Request $request)
    {
        $ids   = getChildIds($request->get('id'), Node::all()); // 获取子集的Id
        $ids[] = (int) $request->get('id'); //加入自己的Id
        if (false !== Node::destroy($ids)) {
            if(false !== NodeRole::whereIn('node_id', $ids)->delete()){
                return ['code' => 1, 'msg' => '删除成功'];
            }else{
                return ['code' => 0 ,'msg' => '删除失败'];
            }
        }else{
            return ['code' => 0 ,'msg' => '删除失败'];
        }    
    }

    public function order(Request $request)
    {
        $param = $request->post();
        $status = true;
        foreach ($param as $id => $sort) {
            if (false === Node::where('id', $id)->update(['sort' => $sort])) {
                $status = false;
            }
        }
        if ($status) {
            return ['code' => 1, 'msg' => '排序更新成功'];
        } else {
            return ['code' => 0, 'msg' => '排序更新失败'];
        }
    }

    public function status($id)
    {
        $node = Node::get($id);
        if ($node->status == 1) {
            $node->status = 0;
            $node->save();
            return ['code' => 1, 'msg' => '已禁止'];
        } else {
            $node->status = 1;
            $node->save();
            return ['code' => 0, 'msg' => '已开启'];
        }
    }
}
