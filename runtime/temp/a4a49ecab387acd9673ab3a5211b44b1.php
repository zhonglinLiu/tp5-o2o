<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:62:"F:\study\o2o\public/../application/admin\view\admin\index.html";i:1496499312;s:64:"F:\study\o2o\public/../application/admin\view\public\header.html";i:1496219444;s:64:"F:\study\o2o\public/../application/admin\view\public\footer.html";i:1496219445;}*/ ?>
<!--包含头部文件-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<script type="text/javascript" src="lib/PIE_IE678.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="__STATIC__/admin/hui/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/admin/hui/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/admin/hui/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/admin/hui/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/admin/hui/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="__STATIC__/admin/css/common.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>o2o平台</title>
<meta name="keywords" content="tp5打造o2o平台系统">
<meta name="description" content="o2o平台">
</head>
<body>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 会员管理 <span class="c-gray en">&gt;</span> 会员列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="page-container">
	<form method="post" action="<?php echo url('admin/index'); ?>" >
		<div class="text-c"> 登录时间：
			<input type="text" onfocus="WdatePicker()" id="datemin" name="begin_time" value="<?php echo $begin_time; ?>" class="input-text Wdate" style="width:120px;">
			-
			<input type="text" onfocus="WdatePicker()" id="datemax"  value="<?php echo $end_time; ?>" name="end_time" class="input-text Wdate" style="width:120px;">
			<input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="name" value="<?php echo $name; ?>">
			<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
		</div>
	</form>
	
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="100">用户名</th>
				<th width="150">手机</th>
				<th width="150">邮箱</th>
				<th width="150">最近登录ip</th>
				<th width="130">加入时间</th>
				<th width="130">最后登录时间</th>
				<th width="70">状态</th>
				<th width="150">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($users) || $users instanceof \think\Collection || $users instanceof \think\Paginator): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			<tr class="text-c">
				<td><input type="checkbox" value="1" name=""></td>
				<td><?php echo $vo->id; ?></td>
				<td><u style="cursor:pointer" class="text-primary" onclick="member_show('<?php echo $vo['username']; ?>','show.html','10001','360','400')"><?php echo $vo['username']; ?></u>
				</td>
				<td><?php echo $vo['mobile']; ?></td>
				<td><?php echo $vo['email']; ?></td>
				<td><?php echo $vo['last_login_ip']; ?></td>
				<td class="text-l"><?php echo $vo['create_time']; ?></td>
				<td><?php echo $vo['last_login_time']; ?></td>
				<td class="td-status"><?php if($vo['status'] == 4): ?>超级管理员<?php else: ?><?php echo status($vo['status']); endif; ?></td>
				<td class="td-manage">
					<?php if($vo['status'] != 4): ?>
					<a style="text-decoration:none" onClick="<?php if($vo['status'] == 1): ?>member_stop(this,<?php echo $vo['id']; ?>)<?php else: ?>member_start(this,<?php echo $vo['id']; ?>)<?php endif; ?>" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i>
					<?php endif; ?>
					</a>
					 <a title="编辑" href="javascript:;" onclick="member_edit('编辑','<?php echo url('admin/edit',['id'=>$vo->id]); ?>','','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="change_password('修改密码','<?php echo url('admin/changepass',['id'=>$vo['id']]); ?>','10001','600','270')" href="javascript:;" title="修改密码"><i class="Hui-iconfont">&#xe63f;</i>
					 </a> 
					 <?php if($vo['status'] != 4): ?>
					 <a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo $vo['id']; ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i>
					 <?php endif; ?>
					 </a>
				 </td>
			</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	</div>
</div>
<?php echo renderPagination($users); ?>
<!--包含头部文件-->
<script type="text/javascript" src="__STATIC__/admin/hui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__STATIC__/admin/hui/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="__STATIC__/admin/hui/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="__STATIC__/admin/hui/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="__STATIC__/admin/hui/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="__STATIC__/admin/hui/lib/jquery.validation/1.14.0/messages_zh.min.js"></script>
<script type="text/javascript" src="__STATIC__/admin/hui/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__STATIC__/admin/hui/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__STATIC__/js/common.js"></script>
<script type="text/javascript" src="__STATIC__/js/uploadify/jquery.uploadify.js"></script>
<script type="text/javascript" src="__STATIC__/js/image.js"></script>
<script type="text/javascript" src="__STATIC__/js/dialog.js"></script>
<script type="text/javascript">
/*$(function(){
	$('.table-sort').dataTable({
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
		]
	});
	$('.table-sort tbody').on( 'click', 'tr', function () {
		if ( $(this).hasClass('selected') ) {
			$(this).removeClass('selected');
		}
		else {
			table.$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});
});*/
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		
		var url = "<?php echo url('admin/status'); ?>?id="+id+'&status=2';
		$.get(url,function(d){

			if(d.code != 1){
				layer.msg('修改失败!',{icon: 5,time:1000});
			}else{
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,'+id+')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
				$(obj).remove();
				layer.msg('已停用!',{icon: 5,time:1000});
			}
				
		})
			
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		var url = "<?php echo url('admin/status'); ?>?id="+id+'&status=1';
		$.get(url,function(d){
			
			if(d.code != 1){
				layer.msg('修改失败!',{icon: 5,time:1000});
			}else{
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,'+id+')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
				$(obj).remove();
				layer.msg('已启用!',{icon: 6,time:1000});
			}
		})
				
	});
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
	layer_show(title,url,w,h);	
}
/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var url = "<?php echo url('admin/del'); ?>";
		var data = {
			'id':id
		};
		$.post(url,data,function(d){
			if(d.code!=1){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			}else{
				layer.msg('删除失败!',{icon:1,time:1000});
			}
		},'JSON');
		
	});
}
</script> 

