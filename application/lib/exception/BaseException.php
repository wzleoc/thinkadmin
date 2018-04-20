<?php
namespace app\lib\exception;

use think\Exception;

class BaseException extends Exception
{
	public $status = 400;
    public $code   = -1;
    public $msg    = '非法请求';
	public function __construct($msg = '非法请求'){
		parent::__construct();
		$this->msg = $msg;
	}    
}
