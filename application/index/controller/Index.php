<?php
namespace app\index\controller;

use app\admin\model\Product;

use app\admin\model\Cate;

class Index
{
    public function _empty(){
        return json(['code' => -1 , 'msg' => 'Sorry The frame only been used by Api request']);
    }
}
