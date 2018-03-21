<?php /*a:3:{s:83:"C:\Users\Administrator\Desktop\smallprogram\application/admin/view\admin\index.html";i:1521604270;s:85:"C:\Users\Administrator\Desktop\smallprogram\application/admin/view\public\header.html";i:1518183050;s:85:"C:\Users\Administrator\Desktop\smallprogram\application/admin/view\public\footer.html";i:1518183083;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>用户列表</h5>
        </div>
        <input type="hidden" name="page" id="page1" value="<?php echo htmlentities($p); ?>">
        <div class="ibox-content">
            <!--搜索框开始-->           
            <div class="row">
                <div class="col-sm-12">   
                    <div  class="col-sm-2" style="width: 100px">
                        <div class="input-group" >  
                            <a href="<?php echo url('admin/create'); ?>"><button class="btn btn-outline btn-primary" type="button">添加用户</button></a> 
                        </div>
                    </div>                                            
                    <form name="admin_list_sea" class="form-search" method="post" action="<?php echo url('admin/index'); ?>">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" id="key" class="form-control" name="key" value="<?php echo htmlentities($key); ?>" placeholder="输入需查询的用户名" />   
                                <span class="input-group-btn"> 
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> 搜索</button> 
                                </span>
                            </div>
                        </div>
                    </form>
                    <div  class="col-sm-2" style="width: 100px">
                        <div class="input-group" >  
                            <a><button class="btn btn-outline btn-danger" type="button" id="delete">批量删除</button></a> 
                        </div>
                    </div>                    
                </div>
            </div>
            <!--搜索框结束-->
            <div class="hr-line-dashed"></div>
            
            <table id="demo" lay-filter="test" lay-data="{id: 'idTest'}"></table>
            <!-- End Example Pagination -->
        </div>
    </div>
</div>
<!-- End Panel Other -->
</div>

<!-- 加载动画 -->
<div class="spiner-example">
    <div class="sk-spinner sk-spinner-three-bounce">
        <div class="sk-bounce1"></div>
        <div class="sk-bounce2"></div>
        <div class="sk-bounce3"></div>
    </div>
</div>

<script src="/static/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/static/admin/js/content.min.js?v=1.0.0"></script>
<script src="/static/admin/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/static/admin/js/plugins/iCheck/icheck.min.js"></script>
<script src="/static/admin/js/plugins/switchery/switchery.js"></script><!--IOS开关样式 -->
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<!--<script src="/static/admin/js/plugins/layer/laydate/laydate.js"></script> 
<script src="/static/admin/js/laypage/laypage.js"></script>
<script src="/static/admin/js/laytpl/laytpl.js"></script> -->
<script src="/static/admin/js/artisan.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>
<script>
    layui.use('table', function(){
        var table = layui.table;
        var page = 1;
        var allPage;
        var limit;
        table.render({ //其它参数在此省略
            id: 'idTest',  // 设定容器唯一ID
            elem: '#demo', // 绑定表格元素
            skin: 'row', //行边框风格
            even: true, //开启隔行背景
            size: 'lg', //大小尺寸的表格
            cols:  [[ //标题栏
                //{checkbox: true,width:'5%'},
                {field:'',type:'checkbox',width:'5%'},
                {field:'',title:'序号',type:'numbers',width:'5%'},
                //{field: 'id', title: 'ID', width: '5%' ,sort:true,align:'center',unresize:true},
                {field: 'name', title: '管理员名称', width: '10%' , sort:true,align:'center',unresize:true},
                {field: "avatar", title: '头像', width: '10%' ,height: 120 ,sort:true,align:'center',unresize:true,templet : '#avatarTpl'},
                {field: 'status', title: '状态', width: '10%' ,height: 120 ,sort:true,align:'center',templet:'#statusTpl',unresize:true },
                {field: 'role_id', title: '角色' , width: '10%',sort:true,align:'center',unresize:true,templet:'#roleTpl'},
                {field: 'create_time', title: '创建时间' , width: '15%',sort:true,align:'center',unresize:true},
                {field: 'update_time', title: '更新时间' , width: '15%',sort:true,align:'center',unresize:true},
                {fixed:'right',width:'20%', align:'center', toolbar: '#barDemo',title:'操作',unresize:true}
            ]],
            url: "<?php echo url('Admin/getData'); ?>",//后台请求的路径
            where: {key: $('#key').val()}, //如果无需传递额外参数，可不加该参数
            method: 'get', //如果无需自定义HTTP类型，可不加该参数
            page: {
                curr : "<?php echo htmlentities($p); ?>"
            }, //是否开启分页
            limit : <?php echo htmlentities($list_rows); ?>, // 请求条数
            limits: [<?php echo htmlentities($list_rows); ?>,1.5*<?php echo htmlentities($list_rows); ?>,2*<?php echo htmlentities($list_rows); ?>], //变换请求条数
            //request: {} //如果无需自定义请求参数，可不加该参数
            //response: {} //如果无需自定义数据响应名称，可不加该参数
            done: function(res, curr, count){
                page = curr; //得到当前页面
                allPage = Math.ceil(count/this.limit);  // 算出总页数
                limit = this.limit;
                //如果是异步请求数据方式，res即为你接口返回的信息。
                //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
                //得到当前页码
                //console.log(curr); 
                $('.spiner-example').css('display','none');
                //得到数据总量
                //console.log(count);
            }
        });
        table.on('tool(test)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
            // console.log(obj); return false;

            var data = obj.data; //获得当前行数据
            var layEvent = obj.event; //获得 lay-event 对应的值
            var tr = obj.tr; //获得当前行 tr 的DOM对象
            //var checkStatus = table.checkStatus('idTest');  可查看具体勾选项信息
            if(layEvent === 'detail'){ //查看
                 
                //console.log(checkStatus.data);
            } else if(layEvent === 'del'){ //删除
                layer.confirm('真的删除行么', function(index){
                    //obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                    $.ajax({
                        url:"<?php echo url('admin/delete'); ?>",
                        data : {id:obj.data.id},
                        dataType : 'json',
                        type: 'get',
                        success : function( data ){
                            if(data.code == 1){
                                layer.msg(data.msg,{icon:1,time:500},function(index){
                                    if(Math.ceil(data.count/limit) < allPage){
                                        table.reload('idTest', {     //指定容器唯一ID
                                            url: "<?php echo url('admin/getData'); ?>",  // 后台请求路径
                                            where: {key: $('#key').val()}, //设定异步数据接口的额外参数
                                            page : {
                                                curr : allPage-1
                                            }
                                        });
                                    }else{
                                        table.reload('idTest', {     //指定容器唯一ID
                                            url: "<?php echo url('admin/getData'); ?>",  // 后台请求路径
                                            where: {key: $('#key').val()} //设定异步数据接口的额外参数
                                        });
                                    }
                                });
                            }
                        },
                        error : function(){
                            // layer.msg('无权删除',{icon:4,time:1500,shade: 0.1},function(index){
                            //     layer.close(index);   
                            // });
                            //for laravel
                        }
                    })
                    //向服务端发送删除指令
                });
            } else if(layEvent === 'edit'){ //编辑
                location.href = '/admin/admin/edit/id/'+obj.data.id+'/page/'+page+'.html';
                //同步更新缓存对应的值
            }
        });
        // 批量操作
        $('#delete').click(function(){
            layer.confirm('真的删除么',function(index1){
                var checkStatus = table.checkStatus('idTest');
                if(checkStatus.data.length == 0){
                    layer.msg('请勾选删除',{icon:2,time:1000},function(index){
                        layer.close(index);
                    });
                    return false;
                }
                var arrIds = [];
                for( var i = 0 ; i < checkStatus.data.length ; i++){
                    arrIds.push(checkStatus.data[i].id);
                }

                $.ajax({
                    url:"<?php echo url('admin/deleteMany'); ?>",
                    type:'post',
                    data:{'arrIds':arrIds},
                    dataType: 'json',
                    success : function( data ){
                        if(data.code == 1){
                            layer.msg(data.msg,{icon:1,time:1500},function(index){
                                layer.close(index);
                                if(Math.ceil(data.count/limit) < allPage){
                                    table.reload('idTest', {     //指定容器唯一ID
                                        url: "<?php echo url('admin/getData'); ?>",  // 后台请求路径
                                        where: {key: $('#key').val()}, //设定异步数据接口的额外参数
                                        page : {
                                            curr : allPage-1
                                        }
                                    });
                                }else{
                                    table.reload('idTest', {     //指定容器唯一ID
                                        url: "<?php echo url('admin/getData'); ?>",  // 后台请求路径
                                        where: {key: $('#key').val()} //设定异步数据接口的额外参数
                                    });
                                }
                                
                            });
                            
                        }
                    },
                    error : function(data){
                        //layer.msg('无权访问',{icon:4,time:1500});  for laravel
                    }
                })
            })
        }); 
    });
    function user_state(id){
        $.ajax({
            url : "<?php echo url('admin/status'); ?>",
            data : {id:id},
            type : 'get',
            dataType : 'json',
            success : function(data){
                if(data.code==1){
                    var a='<span class="label label-danger">禁用</span>'
                    $('#zt'+id).html(a);
                    layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
                    layui.use('table', function(){
                        var table = layui.table;
                        table.reload('idTest', {     //指定容器唯一ID
                            url: "<?php echo url('admin/getData'); ?>",  // 后台请求路径
                            where: {key: $('#key').val()} //设定异步数据接口的额外参数
                        });
                    });
                }else{
                    var b='<span class="label label-info">开启</span>'
                    $('#zt'+id).html(b);
                    layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
                    layui.use('table', function(){
                        var table = layui.table;
                        table.reload('idTest', {     //指定容器唯一ID
                            url: "<?php echo url('admin/getData'); ?>",  // 后台请求路径
                            where: {key: $('#key').val()} //设定异步数据接口的额外参数
                        });
                    });
                    return false;
                }
            },
            error : function(data){
                //layer.msg('未通过验证',{icon:4,time:1500});   for laravel
            }
        });
    }
</script>
<script type="text/html" id="barDemo">
    <!-- <a class="btn btn-success btn-outline btn-xs" lay-event="detail"><i class="fa fa-eye"></i>查看</a>&nbsp;&nbsp; -->
    <a class="btn btn-primary btn-outline btn-xs" lay-event="edit"><i class="fa fa-paste"></i>编辑</a>&nbsp;&nbsp;
    <a class="btn btn-danger btn-outline btn-xs" lay-event="del"><i class="fa fa-trash-o"></i>删除</a>
  
</script>
<script type="text/html" id="statusTpl">
    {{# if(d.status==1){ }}
        <a class="red" href="javascript:;" onclick="user_state({{d.id}});">
            <div id="zt{{d.id}}"><span class="label label-info">开启</span></div>
        </a>
    {{# }else{ }}
        <a class="red" href="javascript:;" onclick="user_state({{d.id}});">
            <div id="zt{{d.id}}"><span class="label label-danger">禁用</span></div>
        </a>
    {{# } }}
</script>

<script type="text/html" id="roleTpl">
    {{d.role.role_name}}
</script>

<script type="text/html" id="avatarTpl">
    <img src="{{d.avatar}}" width="38" class="img-circle" onerror="this.src = '/default.gif'">
</script>

</body>
</html>