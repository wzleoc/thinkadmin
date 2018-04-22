<?php
namespace app\lib\exception;

use think\Validate;

class ValidateException extends BaseException
{
	public function __construct(Validate $validate , $code = -1 , $status = 400){
		parent::__construct($validate->getError() , $code , $status);
	}    
}