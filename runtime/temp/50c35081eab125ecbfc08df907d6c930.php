<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"F:\study\o2o\public/../application/admin\view\bis_location\apply.html";i:1490614280;s:64:"F:\study\o2o\public/../application/admin\view\public\header.html";i:1490000720;s:64:"F:\study\o2o\public/../application/admin\view\public\footer.html";i:1490865711;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="/__STATIC__/admin/hui/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/__STATIC__/admin/hui/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/__STATIC__/admin/hui/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/__STATIC__/admin/hui/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/__STATIC__/admin/hui/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/__STATIC__/admin/css/common.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>o2o平台</title>
<meta name="keywords" content="tp5打造o2o平台系统">
<meta name="description" content="o2o平台">
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 商户入驻申请 </nav>
<div class="page-container">


	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="80">ID</th>
					<th width="100">门店名称</th>
					<th width="100">所属商户</th>
					<th width="60">旗舰店</th>
					<th width="100">联系人</th>
					<th width="150">联系电话</th>
					<th width="60">申请时间</th>
					<th width="60">状态</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($stores) || $stores instanceof \think\Collection || $stores instanceof \think\Paginator): $i = 0; $__LIST__ = $stores;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
				<tr class="text-c">
					<td><?php echo $v['id']; ?></td>
					<td><?php echo $v['name']; ?></td>
					<td><a href="javascript:;" onClick="o2o_s_edit('商户详情','<?php echo url('bis/detail',['id'=>$v['bis_id']]); ?>','',300)"><?php echo $v['bis_name']; ?></a></td>
					<td><?php if($v['is_main'] == 1): ?>是<?php else: ?>否<?php endif; ?></td>
					<td class="text-c"><?php echo $v['contact']; ?></td>
					<td class="text-c"><?php echo $v['tel']; ?></td>
					<td><?php echo $v['create_time']; ?></td>
					<td class="td-status"><a href="<?php echo url('BisLocation/status',['status'=>$v['status']==1?0:1,'id'=>$v['id']]); ?>" title="点击修改状态"><?php echo status($v['status']); ?></a></td>

					<td class="td-manage">
						<a style="text-decoration:none" class="ml-5" onClick="o2o_s_edit('商户详情','<?php echo url('BisLocation/detail',['id'=>$v['id']]); ?>','',300)" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
						<a style="text-decoration:none" class="ml-5" onClick="o2o_del('<?php echo url('BisLocation/status',['id'=>$v['id'],'status'=>-1]); ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
						<a style="text-decoration:none" class="ml-5" onClick="o2o_del('<?php echo url('BisLocation/status',['id'=>$v['id'],'status'=>2]); ?>')" href="javascript:;" title="驳回"><i class="Hui-iconfont">驳回申请</i></a>
					</td>
				</tr>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
	</div>
	<?php echo renderPagination($stores); ?>
</div>
<!--包含头部文件-->
<script type="text/javascript" src="/__STATIC__/admin/hui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/__STATIC__/admin/hui/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/__STATIC__/admin/hui/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/__STATIC__/admin/hui/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="/__STATIC__/admin/hui/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/__STATIC__/admin/hui/lib/jquery.validation/1.14.0/messages_zh.min.js"></script>
<script type="text/javascript" src="/__STATIC__/admin/hui/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/__STATIC__/admin/hui/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/__STATIC__/js/common.js"></script>
<script type="text/javascript" src="/__STATIC__/js/uploadify/jquery.uploadify.js"></script>
<script type="text/javascript" src="/__STATIC__/js/image.js"></script>
<script type="text/javascript" src="/__STATIC__/js/dialog.js"></script>
