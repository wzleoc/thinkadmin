<?php
namespace app\index\controller;

class Index
{
    public function _empty(){
        return json([
        	'msg' => '为API而生'
        ]);
    }
}
