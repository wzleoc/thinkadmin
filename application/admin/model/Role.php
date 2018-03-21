<?php

namespace app\admin\model;

use think\Model;

class Role extends Model{
	
    public function admins(){
    	return $this->hasMany('Admin');
    }

    public function nodes(){
    	return $this->belongsToMany('Node','node_role');
    }

    public function getNodeInfo(){
        $allNodes = Node::field('id,title,pid')->order('sort')->select();
        $nodeIds = $this->nodes()->column('id');
        $arr = [];
        foreach ($allNodes as $node) {
            if(in_array($node['id'],$nodeIds)){
                $node['checked'] = 1;
            }
            $node['name'] = $node['title'];
            $node['pId'] = $node['pid'];
            $arr[] = $node;
        }
        return $arr;
    }
}
