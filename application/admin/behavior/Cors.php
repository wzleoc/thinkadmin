<?php   
namespace app\admin\behavior;   
class Cors
{  
    public function responseSend()  
    {    
    	// 响应头设置 我们就是通过设置header来跨域的 这就主要代码了 定义行为只是为了前台每次请求都能走这段代码  
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:*');    
    	header('Access-Control-Allow-Headers:*');  
    	header('Access-Control-Allow-Credentials:false');  
    }
} 