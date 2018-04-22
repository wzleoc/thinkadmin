<?php   
namespace app\admin\behavior;
class Cors
{  
	// 前后端完全分离的CORS且非简单请求（例如自定义header头信息）！！！
	// 跨域共享
    public function run()
    {      
    	if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    		header('Access-Control-Allow-Origin:http://client.com');
	        header('Access-Control-Allow-Methods:*');
	    	header('Access-Control-Allow-Headers:token');  
	    	header('Access-Control-Allow-Credentials:true'); 
	    	exit();
    	}else{
    		header('Access-Control-Allow-Origin:http://client.com');
	        header('Access-Control-Allow-Methods:*');
	    	header('Access-Control-Allow-Headers:token');  
	    	header('Access-Control-Allow-Credentials:true'); 
    	}
    }
} 