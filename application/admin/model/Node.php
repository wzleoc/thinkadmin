<?php

namespace app\admin\model;

use think\Model;

class Node extends Model{
    public function roles(){
    	return $this->belongsToMany('Role');
    }
}
