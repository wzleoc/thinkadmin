<?php /*a:3:{s:45:"D:\fix\application\admin\view\menu\index.html";i:1524384360;s:48:"D:\fix\application\admin\view\public\header.html";i:1524236245;s:48:"D:\fix\application\admin\view\public\footer.html";i:1524321632;}*/ ?>
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
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>菜单列表</h5>
        </div>
        <div class="ibox-content">          
            <div class="row">
                <div class="col-sm-12">   
                    <div  class="col-sm-2">
                        <div class="input-group" >  
                            <button type="button" class="btn btn-primary btn-outline" data-toggle="modal" data-target="#myModal">添加菜单</button> 
                        </div>
                    </div>                                                                                        
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <form id="ruleorder" name="ruleorder" method="post" action="<?php echo url('order'); ?>" >
                        <input type="hidden" name="token" class="token">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="long-tr">
                                    <th width="6%">ID</th>
                                    <th width="19%">权限名称</th>
                                    <th width="15%">节点</th>
                                    <th width="15%">菜单状态</th>
                                    <th width="18%">添加时间</th>
                                    <th width="10%">排序</th>
                                    <th width="15%">操作</th>
                                </tr>
                            </thead>
                            <tbody>                       
                                <?php foreach($nodes as $node): ?>
                                    <tr class="long-td">
                                        <td><?php echo htmlentities($node['id']); ?></td>
                                        <td style='text-align:left;padding-left:<?php if(($node['leftpin'] == 0)): ?><?php echo htmlentities($node['leftpin']); ?>px<?php endif; ?>'><?php echo htmlentities($node['lefthtml']); ?><?php echo htmlentities($node['title']); ?></td>
                                        <td><?php echo htmlentities($node['name']); ?></td>                                  
                                        <td>
                                            <?php if(($node['status'] == 1)): ?>
                                                <a class="red" href="javascript:;" onclick="rule_state(<?php echo htmlentities($node['id']); ?>);">
                                                    <div id="zt<?php echo htmlentities($node['id']); ?>"><span class="label label-info">开启</span></div>
                                                </a>
                                            <?php else: ?>
                                                <a class="red" href="javascript:;" onclick="rule_state(<?php echo htmlentities($node['id']); ?>);">
                                                    <div id="zt<?php echo htmlentities($node['id']); ?>"><span class="label label-danger">禁用</span></div>
                                                </a>
                                            <?php endif; ?> 
                                        </td>
                                        <td><?php echo htmlentities($node['create_time']); ?></td>
                                        <td style="padding: 3px" >
                                            <div >
                                                <input name="<?php echo htmlentities($node['id']); ?>" value=" <?php echo htmlentities($node['sort']); ?>" width="50%" style="text-align:center;" class="form-control">
                                            </div>
                                        </td>                                                             
                                        <td>                                   
                                            <a href="<?php echo url('edit',['id'=>$node['id']]); ?>" class="btn btn-primary btn-outline btn-xs">
                                                <i class="fa fa-paste"></i> 编辑</a>&nbsp;&nbsp;
                                            <a href="javascript:;" onclick="del_rule(<?php echo htmlentities($node['id']); ?>)" class="btn btn-danger btn-outline btn-xs">
                                                <i class="fa fa-trash-o"></i> 删除</a>                                       
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="8" align="right">
                                    <button type="submit"  id="btnorder" class="btn btn-info">更新排序</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
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
<script src="/static/admin/js/artisan.js"></script>
<script src="https://cdn.bootcss.com/jquery-cookie/1.4.0/jquery.cookie.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>
    <div class="modal  fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title">添加菜单</h3>                  
                </div>
                <form class="form-horizontal" name="add_rule" id="add_rule" method="post" action="<?php echo url('Menu/MenuStore'); ?>">
                    <input type="hidden" name="token" class="token">
                        <div class="ibox-content">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">所属父级</label>
                                <div class="col-sm-8">                                                      
                                    <select name="pid" class="form-control">
                                        <option value="0">--默认顶级--</option>
                                        <?php foreach($nodes as $node): ?>
                                            <option value="<?php echo htmlentities($node['id']); ?>" style="margin-left:55px;"><?php echo htmlentities($node['lefthtml']); ?><?php echo htmlentities($node['title']); ?></option>                                          
                                        <?php endforeach; ?>
                                    </select>                                    
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">菜单名称</label>
                                <div class="col-sm-8">
                                    <input type="text" name="title" id="title" placeholder="输入菜单名称" class="form-control"/>
                                </div>
                            </div>                      
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">节点</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" id="name" placeholder="模块/控制器/方法" class="form-control"/>
                                    <span class="help-block m-b-none">如：admin/user/adduser (一级节点添加“#”即可)</span>
                                </div>
                            </div>  
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">CSS样式</label>
                                <div class="col-sm-8">
                                    <input type="text" name="css" id="css" placeholder="输入菜单名称前显示的CSS样式" class="form-control"/>
                                    <span class="help-block m-b-none"> <a href="http://fontawesome.dashgame.com/" target="_black">选择图标</a> 如fa fa-user </span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">排&nbsp;序</label>
                                <div class="col-sm-8">
                                    <input type="text" name="sort" id="sort" value="50" placeholder="输入排序" class="form-control"/>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                            <label class="col-sm-3 control-label">状&nbsp;态</label>
                            <div class="col-sm-6">
                                <div class="radio i-checks">
                                    <input type="radio" name='status' value="1" checked="checked"/>开启&nbsp;&nbsp;
                                    <input type="radio" name='status' value="0" />关闭
                                </div>
                            </div>
                        </div>                  
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> 保存</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> 关闭</button>                    
                    </div>
                </form>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $(function(){
        $('.token').val($.cookie('token'));
    })
    $('#add_rule').ajaxForm({
        beforeSubmit: checkForm, 
        success: complete, 
        error : error,
        dataType: 'json'
    });
    
    function checkForm(){
        if( '' == $.trim($('#title').val())){
            layer.msg('请输入菜单名称',{icon:2,time:1500,shade: 0.1}, function(index){
                layer.close(index);
            });
            return false;
        }
        
        if( '' == $.trim($('#name').val())){
            layer.msg('控制器/方法不能为空',{icon:0,time:1500,shade: 0.1}, function(index){
                layer.close(index);
            });
            return false;
        }
    }


    function complete(data){
        $('.token').val($.cookie('token'))
        if(data.code==1){
            layer.msg(data.msg, {icon: 6,time:1500,shade: 0.1}, function(index){
                window.location.href="<?php echo url('Menu/index'); ?>";
            });
        }else{
            layer.msg(data.msg, {icon: 5,time:1500,shade: 0.1},function(index){
                layer.close(index);
            });
            return false;   
        }
    }

    function error(data){
        layer.msg('无权访问',{icon:4,time:1500,shade: 0.1},function(index){
            layer.close(index);   
        });
    }
     


    //更新排序
    $(function(){
        $('#ruleorder').ajaxForm({
            success: complete, 
            dataType: 'json'
        });

        function complete(data){
            $('.token').val($.cookie('token'))
            if(data.code==1){
                layer.msg(data.msg, {icon: 1,time:1500,shade: 0.1}, function(index){
                    window.location.href="<?php echo url('menu/index'); ?>";
                });
            }else{
                layer.msg(data.msg, {icon: 2,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
            }
        }
    });


function del_rule(id){
    layer.confirm('确认删除此菜单?', {icon: 3, title:'提示'}, function(index){
        //do something
        $.getJSON("<?php echo url('Menu/delete'); ?>", {id : id, token : $.cookie('token')}, function(res){
            $('.token').val($.cookie('token'))
            if(res.code == 1){
                layer.msg(res.msg,{icon:1,time:1500,shade: 0.1},function(index){
                    layer.close(index);
                    window.location.href="<?php echo url('Menu/index'); ?>";
                });
               
            }else{
                layer.msg(res.msg,{icon:0,time:1500,shade: 0.1});
            }
        });

        layer.close(index);
    })

}

//菜单状态
function rule_state(id){
    artisan.status(id,'<?php echo url("status"); ?>');
}

    //IOS开关样式配置
   var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, {
            color: '#1AB394'
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