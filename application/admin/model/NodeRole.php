<?php

namespace app\admin\model;

use think\Model;

class NodeRole extends Model{
	protected $table = 'node_role';
    public static function del($role_id){
    	return self::where(['role_id' => $role_id])->delete();
    }
}
