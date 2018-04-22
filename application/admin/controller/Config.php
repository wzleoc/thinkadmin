<?php

namespace app\admin\controller;

use app\admin\model\Config as ConfigModel;
use think\Request;

class Config extends Base
{
    protected $beforeActionList = [ 
        //小写方法名
        'shouldCheckCsrfToken' => [
            'only' => 'save'
        ]
    ];
    public function index()
    {
        $list   = ConfigModel::all();
        $config = [];
        foreach ($list as $k => $v) {
            $config[trim($v['name'])] = $v['value'];
        }
        return view('index', ['config' => $config]);
    }
    /**
     * 批量保存配置
     */
    public function save($config)
    {
        $configModel = new ConfigModel();
        $status = true;
        if ($config && is_array($config)) {
            foreach ($config as $name => $value) {
                $map = array('name' => $name);
                $result = $configModel->SaveConfig($map, $value);
                if($result['code'] === 0){
                    $status = false;
                    break;
                }
            }
        }
        if($status){
            return json([
                'code' => 1,
                'msg'  => '保存成功！'
            ]);
        }else{
            return json([
                'code' => 0,
                'msg'  => '保存失败!'
            ]);
        }
        // $this->success('保存成功！');
    }
}
