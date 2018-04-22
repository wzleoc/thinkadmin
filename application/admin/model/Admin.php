<?php

namespace app\admin\model;

use think\Model;

class Admin extends Model
{
    public function role(){
        return $this->belongsTo('Role');
    }

    public function setPasswordAttr($value){
        return md5(md5($value));
    }

    public static function checkLogin( $request ){
        $username = $request->post('username');
        $password = $request->post('password');
        if($admin = self::where(['name'=>$username,'password'=>md5(md5($password))])->find()){
            session('admin',$admin);
            return ['code' => 1 , 'msg' => '登录成功' , 'url'=>url('admin/index/index')];
        }
        return ['code' => 2, 'msg' => '账户密码错误'];
    }

    public function getMenu(){
        $nodes = [];
        $nodes = $this->role->nodes()->column('id');
        return $this->getAdminNodes($nodes);
    }
    public function getAdminNodes($nodeArr = []){
        //超级管理员没有节点数组
        if(session('admin.id') == 1){
        	$nodes = Node::where(['status'=>1])->order('sort')->select();
        }else{
        	$nodes = Node::where(['status'=>1])->whereIn('id',$nodeArr)->select();
        }
        return $this->prepareMenu($nodes->toArray());
    }

    public function prepareMenu($param){

        $parent = []; //父类
        $child = [];  //子类
        foreach($param as $key=>$vo){

            if($vo['pid'] == 0){
                $vo['href'] = '#';
                $parent[] = $vo;
            }else{
                $vo['href'] = url($vo['name']); //跳转地址
                $child[] = $vo;
            }
        }

        foreach($parent as $key=>$vo){
            foreach($child as $k=>$v){
                if($v['pid'] == $vo['id']){
                    $parent[$key]['child'][] = $v;
                }
            }
        }
        
        unset($child);
        return $parent;
    }

}
