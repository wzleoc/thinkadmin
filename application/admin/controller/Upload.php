<?php
namespace app\admin\controller;

use think\File;
use think\Request;
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
use app\admin\model\Config;
use think\Controller;


class Upload extends Controller
{
    //图片上传
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $info = $file->move('./uploads/images');
        if ($info) {
            $str = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/images/' . $info->getSaveName();
            //echo str_replace('\\', '/', $str); 兼容小程序
            echo $str;
        } else {
            echo $file->getError();
        }
    }

    public function uploadqiniu()
    {
        if(request()->isPost()){
            $file = request()->file('file');
            // 要上传图片的本地路径
            $filePath = $file->getRealPath();
            $ext = pathinfo($file->getInfo('name'), PATHINFO_EXTENSION);  //后缀
            //获取当前控制器名称
            $controllerName=request()->controller();
            // 上传到七牛后保存的文件名
            $key =substr(md5($file->getRealPath()) , 0, 5). date('YmdHis') . rand(0, 9999) . '.' . $ext;
            //require_once APP_PATH . '/../vendor/autoload.php';
            // 需要填写你的 Access Key 和 Secret Key
            $accessKey = Config::where(['name' => 'qiniu_appkey'])->value('value');
            $secretKey = Config::where(['name' => 'qiniu_secret'])->value('value');
            // 构建鉴权对象
            $auth = new Auth($accessKey, $secretKey);
            // 要上传的空间
            $bucket = Config::where(['name' => 'qiniu_bucket'])->value('value');
            $domain = Config::where(['name' => 'qiniu_domain'])->value('value');
            $token = $auth->uploadToken($bucket);
            // 初始化 UploadManager 对象并进行文件的上传
            $uploadMgr = new UploadManager();
            // 调用 UploadManager 的 putFile 方法进行文件的上传
            list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
            if ($err !== null) {
//              return ["err"=>1,"msg"=>$err,"data"=>""];
                echo  '上传失败';
            } else {
                //返回图片的完整URL
                //return json(["err"=>0,"msg"=>"上传完成","data"=>$domain .'/' .$ret['key']]);
                echo 'http://' . $domain . '/' .$ret['key'];
            }
        }
    }

}
