<?php /*a:3:{s:47:"D:\fix\application\admin\view\config\index.html";i:1524107542;s:48:"D:\fix\application\admin\view\public\header.html";i:1524218937;s:48:"D:\fix\application\admin\view\public\footer.html";i:1524218932;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="">
    <title><?php echo config('WEB_SITE_TITLE'); ?></title>
    <link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/css/animate.min.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="/static/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link rel="stylesheet" href="/static/admin/dist/css/layui.css" media="all">
    <script src="/static/admin/dist/layui.all.js"></script>
    <style type="text/css">
    .long-tr th{
        text-align: center
    }
    .long-td td{
        text-align: center
    }
    </style>
</head>
<style type="text/css">
/* TAB */
.nav-tabs.nav>li>a {
    padding: 10px 25px;
    margin-right: 0;
}
.nav-tabs.nav>li>a:hover,
.nav-tabs.nav>li.active>a {
    border-top: 3px solid #1ab394;
    padding-top: 8px;
    border-bottom: 1px solid #FFFFFF;
}
.nav-tabs>li>a {
    color: #A7B1C2;
    font-weight: 500;  
    margin-right: 2px;
    line-height: 1.42857143;
    border: 1px solid transparent;
    border-radius: 0;
}
</style>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>网站配置</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">       
                    <div class="panel blank-panel">
                        <div class="panel-heading">                     
                            <div class="panel-options">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">基本配置</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">内容配置</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false">七牛云配置</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-4" aria-expanded="false">短信配置</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="<?php echo url('save'); ?>" method="post" class="form-horizontal" id="config">
                                <input type="hidden" name="temp" value="手册写烂不得以">
                                <?php echo token(); ?>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="hr-line-dashed"></div>                                
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">网站标题：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <input type="text" class="form-control" name="config[web_site_title]" value="<?php echo htmlentities($config['web_site_title']); ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 网站标题</span>                                           
                                            </div>
                                        </div>                                 
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">网站描述：</label>
                                            <div class="input-group col-sm-4">
                                                <textarea class="form-control" type="text" rows="3" name="config[web_site_description]"><?php echo htmlentities($config['web_site_description']); ?></textarea>
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 网站搜索引擎描述</span>                                           
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">网站关键字：</label>
                                            <div class="input-group col-sm-4">
                                                <textarea class="form-control" type="text" rows="3" name="config[web_site_keyword]"><?php echo htmlentities($config['web_site_keyword']); ?></textarea>
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 网站搜索引擎关键字</span>                                           
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">网站备案号：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <input type="text" class="form-control" name="config[web_site_icp]" value="<?php echo htmlentities($config['web_site_icp']); ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 设置在网站底部显示的备案号，如“ 川ICP备15095485号-1</span>                                           
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">统计代码：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <textarea class="form-control" type="text" rows="3" name="config[web_site_cnzz]"><?php echo htmlentities($config['web_site_cnzz']); ?></textarea>
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 设置在网站底部显示的站长统计信息</span>                                           
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">版权信息：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <input type="text" class="form-control" name="config[web_site_copy]" value="<?php echo htmlentities($config['web_site_copy']); ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 设置在网站底部显示的版权信息</span>                                           
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">站点状态：</label>
                                            <div class="input-group col-sm-4">
                                                <div class="radio i-checks">
                                                    <input type="radio" name='config[web_site_close]' value="1" <?php if(($config['web_site_close'] ==1)): ?>checked<?php endif; ?>/>开启&nbsp;&nbsp;
                                                    <input type="radio" name='config[web_site_close]' value="0" <?php if(($config['web_site_close'] ==0)): ?>checked<?php endif; ?>/>关闭
                                                </div>
                                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 站点关闭后除管理员外所有人访问不了后台</span>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-3">
                                                <button class="btn btn-primary btn_submit"><i class="fa fa-save"></i> 保存信息</button>
                                            </div>
                                        </div>                              
                                    </div>
                                    <div id="tab-2" class="tab-pane">
                                        <div class="hr-line-dashed"></div>                                
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">后台每页记录数：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <input type="text" class="form-control" name="config[list_rows]" value="<?php echo htmlentities($config['list_rows']); ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 后台数据每页显示记录数</span>                                           
                                            </div>
                                        </div>                                 
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-3">
                                                <button class="btn btn-primary btn_submit"><i class="fa fa-save"></i> 保存信息</button>
                                            </div>
                                        </div>                               
                                    </div>
                                    <div id="tab-3" class="tab-pane">
                                        <div class="hr-line-dashed"></div>                                
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">AppKey：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <input type="text" class="form-control" name="config[qiniu_appkey]" value="<?php echo htmlentities($config['qiniu_appkey']); ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请前往七牛云平台查看AccessKey</span>                                           
                                            </div>
                                        </div> 
                                        <div class="hr-line-dashed"></div>                                
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">AppSecret：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <input type="text" class="form-control" name="config[qiniu_secret]" value="<?php echo htmlentities($config['qiniu_secret']); ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 
                                                请前往七牛云平台查看SecretKey</span>                                           
                                            </div>
                                        </div> 
                                        <div class="hr-line-dashed"></div>                                
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Bucket：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <input type="text" class="form-control" name="config[qiniu_bucket]" value="<?php echo htmlentities($config['qiniu_bucket']); ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请填写七牛云平台存储空间名</span>                                           
                                            </div>
                                        </div>   
                                        <div class="hr-line-dashed"></div>                                
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Domain：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <input type="text" class="form-control" name="config[qiniu_domain]" value="<?php echo htmlentities($config['qiniu_domain']); ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请填写七牛云平台域名</span>                                           
                                            </div>
                                        </div>                              
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-3">
                                                <button class="btn btn-primary btn_submit"><i class="fa fa-save"></i> 保存信息</button>
                                            </div>
                                        </div>                               
                                    </div>
                                    <div id="tab-4" class="tab-pane">
                                      
                                        <div class="hr-line-dashed"></div>                                
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">AppKey：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <input type="text" class="form-control" name="config[alisms_appkey]" value="<?php echo htmlentities($config['alisms_appkey']); ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请前往阿里云云通信平台查看AppKey</span>                                           
                                            </div>
                                        </div>                                 
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">AppSecret：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <input type="text" class="form-control" name="config[alisms_appsecret]" value="<?php echo htmlentities($config['alisms_appsecret']); ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请前往阿里云云通信平台查看AppSecret</span>                                           
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">短信签名：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <input type="text" class="form-control" name="config[alisms_signname]" value="<?php echo htmlentities($config['alisms_signname']); ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请前往阿里云云通信平台查看短信签名</span>                                           
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-3">
                                                <button class="btn btn-primary btn_submit" ><i class="fa fa-save"></i> 保存信息</button>
                                            </div>
                                        </div>                               
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>         
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/static/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/static/admin/js/content.min.js?v=1.0.0"></script>
<script src="/static/admin/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/static/admin/js/plugins/iCheck/icheck.min.js"></script>
<script src="/static/admin/js/plugins/switchery/switchery.js"></script><!--IOS开关样式 -->
<script src="/static/admin/js/plugins/switchery/switchery.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<!--<script src="/static/admin/js/plugins/layer/laydate/laydate.js"></script> 
<script src="/static/admin/js/laypage/laypage.js"></script>
<script src="/static/admin/js/laytpl/laytpl.js"></script> -->
<script src="/static/admin/js/artisan.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>

<script type="text/javascript">
    $('.btn_submit').click(function(){
        $('#config').ajaxForm({
            dataType: 'json',
            success: function(res){
                if(res.code == 1){
                    artisan.success(res.msg , "<?php echo url('Config/index'); ?>");
                }else{
                    layer.msg(res.msg,{icon:5,time:1500,shade: 0.1},function(index){
                        layer.close(index);   
                    });
                }  
            },
            error : function(error){
                layer.msg('无权访问',{icon:4,time:1500,shade: 0.1},function(index){
                    layer.close(index);   
                });
            }
        });
    });
    var config = {
        '.chosen-select': {},                    
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
</script>
</body>
</html>
