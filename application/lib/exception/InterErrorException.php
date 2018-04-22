<?php
namespace app\lib\exception;

class InterErrorException extends BaseException
{
	public function __construct($msg = '服务器内部错误',$code = -1 , $status = 500){
		parent::__construct($msg = '服务器内部错误',$code = -1 , $status = 500);
	}    
}