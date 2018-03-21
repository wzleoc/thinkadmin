<?php

namespace app\index\controller;

use think\Controller;

use GuzzleHttp\Client;

use app\admin\model\Admin;

use app\admin\model\Node;

use app\admin\model\Role;

class User extends Controller
{
	public $client;

	public function __construct(){
		$this->client = new Client();
	}


	public function user($code){
		$url = "https://api.weixin.qq.com/sns/jscode2session?appid=wxdbc4bb2eea159632&secret=216be32f43704b46039b64e1aa70d76c&js_code=$code&grant_type=authorization_code";
    	$response = $this->client->get($url);
    	return $response->getBody();
	}

	public function admins(){
		$admins = Admin::relation(['role' => function($query){
			$query->field('id,role_name')->relation(['nodes' => function($query){
				$query->field('id,name');
			}]);
		}])->select();
		dump($admins);
	}

	public function getNodes(){
		$role = Role::get(1);
		$nodes = Role::where('id',1)->relation(['nodes' => function($query){
			$query->field('name,title')->where('id','<',10);
		}])->find();
		dump($nodes);
	}

	public function role(){
		$role = Role::where('id',1)->relation(['admins' => function($query){
			$query->field('id,name');
		}])->relation(['nodes' => function($query){
			$query->field('id,name');
		}])->find();
		dump($role);
	}
    
}
