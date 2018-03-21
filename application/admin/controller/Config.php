<?php

namespace app\admin\controller;

use app\admin\model\Config as ConfigModel;
use think\Controller;

class Config extends Base
{

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
        if ($config && is_array($config)) {
            foreach ($config as $name => $value) {
                $map = array('name' => $name);
                $configModel->SaveConfig($map, $value);
            }
        }
        $this->success('保存成功！');
    }
}
