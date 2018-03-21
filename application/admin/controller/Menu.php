<?php

namespace app\admin\controller;

use app\admin\model\Node;
use app\admin\model\NodeRole;
use think\Request;

class Menu extends Base
{
    public function index()
    {
        $nodes = rule(Node::order('sort')->select());
        return view('index', ['nodes' => $nodes]);
    }

    public function menuStore(Request $request)
    {
        if (is_null($request->post('css'))) {
            $data = $request->except(['css']);
        } else {
            $data = $request->post();
        }
        if (Node::create($data)) {
            return ['code' => 1, 'msg' => '创建菜单成功'];
        }
    }

    public function edit($id)
    {
        return view('edit', ['menu' => Node::get($id)]);
    }

    public function update(Request $request)
    {
        if (is_null($request->post('css'))) {
            $data = $request->except(['css']);
        } else {
            $data = $request->post();
        }
        if (false !== Node::update($data)) {
            return ['code' => 1, 'msg' => '更新成功'];
        }
    }

    public function delete(Request $request)
    {
        $ids   = getChildIds($request->get('id'), Node::all()); // 获取子集的Id
        $ids[] = (int) $request->get('id'); //加入自己的Id
        if (Node::destroy($ids)) {
            NodeRole::whereIn('node_id', $ids)->delete();
        }
        return ['code' => 1, 'msg' => '删除成功'];
    }

    public function order(Request $request)
    {
        $param = $request->post();
        foreach ($param as $id => $sort) {
            Node::where('id', $id)->update(['sort' => $sort]);
        }
        return ['code' => 1, 'msg' => '排序更新成功'];
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
