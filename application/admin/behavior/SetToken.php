<?php   
namespace app\admin\behavior;
class SetToken
{  
    public function run()
    {   
    	$token = md5(session('admin.id') . 'LaravelForever' . mt_rand(0,99999));
    	session('csrftoken',$token);
    	cookie('token',$token);
    }
} 