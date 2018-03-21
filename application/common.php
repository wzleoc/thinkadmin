<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use think\Db;
use Aliyun\Core\Config;  
use Aliyun\Core\Profile\DefaultProfile;  
use Aliyun\Core\DefaultAcsClient;  
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest; 
use app\admin\model\Config as ConfigModel;
function page( $page , $limits , $allPage , $lists){
	if($lists->count() == 0){
		return '';
	}
    $data = [];
    for($i = 1 ; $i <= $allPage ; $i++){
        for($j = $limits*($i-1) ; $j < $limits*$i ; $j++ ){
            if(isset($lists[$j])){
                $data[$i][] = $lists[$j];
            }    
        }
    }
    if(isset($data[$page])){
        return $data[$page];
    }else{
        return [];
    }
     
}

// 左侧菜单无极分类
function rule($cate , $lefthtml = '— — ' , $pid=0 , $lvl=0, $leftpin=0 ){
    $arr=array();
    foreach ($cate as $v){
        if($v['pid']==$pid){
            $v['lvl']=$lvl + 1;
            $v['leftpin']=$leftpin + 0;//左边距
            $v['lefthtml']=str_repeat($lefthtml,$lvl);
            $arr[]=$v;
            $arr= array_merge($arr,rule($cate,$lefthtml,$v['id'],$lvl+1 , $leftpin+20));
        }
    }
    return $arr;
}

// 获取所有子集id数组
function getChildIds( $id , $nodes){
    $arr = [];
    foreach($nodes as $node){
        if($node->pid == $id){
            $arr[] = $node->id;
            $arr = array_merge($arr , getChildIds($node->id , $nodes));
        }
    }
    return $arr;
}

/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '') {
    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
    for ($i = 0; $size >= 1024 && $i < 5; $i++) {
        $size /= 1024;
    }
    return $size . $delimiter . $units[$i];
}
/**
* 验证手机号是否正确
* @author honfei
* @param number $mobile
*/
function isMobile($mobile) {
    if (!is_numeric($mobile)) {
        return false;
    }
    return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
}

/** 
 * 阿里云云通信发送短息 
 * @param string $mobile    接收手机号 
 * @param string $tplCode   短信模板ID
 * @param array  $tplParam  短信内容
 * @return array 
 */  
function sendMsg($mobile,$tplCode,$tplParam){  
    if( empty($mobile) || empty($tplCode) ) return array('Message'=>'缺少参数','Code'=>'Error');  
    if(!isMobile($mobile)) return array('Message'=>'无效的手机号','Code'=>'Error');  
      
    require_once '../extend/aliyunsms/vendor/autoload.php';  
    Config::load();             //加载区域结点配置   
    $accessKeyId = ConfigModel::where(['name' => 'alisms_appkey'])->value('value');
    $accessKeySecret = ConfigModel::where(['name' => 'alisms_appsecret'])->value('value');
    if( empty($accessKeyId) || empty($accessKeySecret) ) return array('Message'=>'请先在后台配置appkey和appsecret','Code'=>'Error'); 
    $templateParam = $tplParam; //模板变量替换  
    
    //$signName = (empty(config('alisms_signname'))?'阿里大于测试专用':config('alisms_signname'));  
    //$signName = config('alisms_signname');
    $signName = ConfigModel::where(['name' => 'alisms_signname'])->value('value');
    //短信模板ID 
    $templateCode = $tplCode;   
    //短信API产品名（短信产品名固定，无需修改）  
    $product = "Dysmsapi";  
    //短信API产品域名（接口地址固定，无需修改）  
    $domain = "dysmsapi.aliyuncs.com";  
    //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改）  
    $region = "cn-hangzhou";     
    // 初始化用户Profile实例  
    $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);  
    // 增加服务结点  
    DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);  
    // 初始化AcsClient用于发起请求  
    $acsClient= new DefaultAcsClient($profile);  
    // 初始化SendSmsRequest实例用于设置发送短信的参数  
    $request = new SendSmsRequest();  
    // 必填，设置雉短信接收号码  
    $request->setPhoneNumbers($mobile);  
    // 必填，设置签名名称  
    $request->setSignName($signName);  
    // 必填，设置模板CODE  
    $request->setTemplateCode($templateCode);  
    // 可选，设置模板参数     
    if($templateParam) {
        $request->setTemplateParam(json_encode($templateParam));
    }
    //发起访问请求  
    $acsResponse = $acsClient->getAcsResponse($request);   
    //返回请求结果  
    $result = json_decode(json_encode($acsResponse),true); 

    return $result;  
}  

/**
 * 字符串截取，支持中文和其他编码
 */
function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true) {
    if (function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif (function_exists('iconv_substr')) {
        $slice = iconv_substr($str, $start, $length, $charset);
        if (false === $slice) {
            $slice = '';
        }
    } else {
        $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("", array_slice($match[0], $start, $length));
    }
    return $suffix ? $slice . '...' : $slice;
}
