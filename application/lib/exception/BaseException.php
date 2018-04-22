<?php
namespace app\lib\exception;

use think\Exception;

class BaseException extends Exception
{
	public $status;
    public $code;
    public $msg;
	public function __construct($msg = '请求参数错误',$code = -1 , $status = 400){
		parent::__construct();
		$this->msg = $msg;
		$this->code = $code;
		$this->status = $status;
	}    
}
