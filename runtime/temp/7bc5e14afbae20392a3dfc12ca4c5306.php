<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:60:"F:\study\o2o\public/../application/bis\view\manager\add.html";i:1491575440;s:62:"F:\study\o2o\public/../application/bis\view\public\header.html";i:1490263172;s:62:"F:\study\o2o\public/../application/bis\view\public\footer.html";i:1490266032;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="/__STATIC__/admin/hui/static/h-ui.admin/css/style.css" />
  <link rel="stylesheet" type="text/css" href="/__STATIC__/admin/css/common.css" />
  <link rel="stylesheet" type="text/css" href="/__STATIC__/js/uploadify/uploadify.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>o2o平台</title>
<meta name="keywords" content="tp5打造o2o平台系统">
<meta name="description" content="o2o平台">
</head>
<body>
<div class="page-container">
	<form class="form form-horizontal form-o2o-add" id="liu-form" method="post" action="<?php echo url('manager/save'); ?>">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>管理员名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text check_null" attr-msg='用户名不能为空' value="<?php if($flog == 1): ?><?php echo $model['username']; endif; ?>" placeholder="必填" id="name" name="username">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>密码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="password" class="input-text check_null password" attr-msg='密码不能为空' value="" placeholder="必填" id="name" name="password">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>确认密码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="password" class="input-text repass" value="" attr-msg='确认密码不能为空' placeholder="必填" id="name" name="repass">
			</div>
		</div>
		
		
		<div class="row cl check_form">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button  type="button" id="liu-submit" class="btn btn-primary radius" ><i class="Hui-iconfont">&#xe632;</i> 保存</button>
				
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
		<input type="hidden" name="id" value="<?php if($flog == 1): ?><?php echo $model['id']; endif; ?>">
	</form>
</div>
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

<script type="text/javascript">
	$('.repass').blur(function(){
		if(this.value!=$('.password').val()){
			dialog.tip('密码与确认密码不一致',this);
		}
	})
var SCOPE = {
	save_url:'<?php echo url("manager/add"); ?>',
	jump_url:'',
}
</script>
