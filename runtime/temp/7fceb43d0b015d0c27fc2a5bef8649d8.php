<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"F:\study\o2o\public/../application/admin\view\bis_location\detail.html";i:1496140000;s:64:"F:\study\o2o\public/../application/admin\view\public\header.html";i:1490000720;s:64:"F:\study\o2o\public/../application/admin\view\public\footer.html";i:1490865711;}*/ ?>
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
<div class="cl pd-5 bg-1 bk-gray mt-20"> 添加分店信息</div>
<article class="page-container">
    <form class="form form-horizontal" id="form-article-add" method="post" action="">
        基本信息：
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分店名称：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="<?php echo $store['name']; ?>" placeholder="" id="" name="name">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">银行账号:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="<?php echo $store['bank_info']; ?>" placeholder="" id="" name="bank_info">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属城市：</label>
            <div class="formControls col-xs-8 col-sm-2">
				<?php echo $store['city']['name']; ?>
            </div>
            <div class="formControls col-xs-8 col-sm-2">
				<?php echo $store['city_info']['name']; ?>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">缩略图：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <img id="upload_org_code_img" src="<?php echo $store['logo']; ?>" width="150" height="150">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">门店介绍：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <script id="editor"  type="text/plain" name="content" style="width:80%;height:300px;"><?php echo $store['content']; ?></script>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属分类：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <?php echo $store['category']['name']; ?>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">所属子类：</label>
            <div class="formControls col-xs-8 col-sm-3 skin-minimal">
                <div class="check-box se_category_id">
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">地址：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text"  class="input-text" value="<?php echo $store['address']; ?>" placeholder="" id="bis-address" name="address">
            </div>

        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">电话:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="<?php echo $store['tel']; ?>" placeholder="" id="" name="tel">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">联系人:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="<?php echo $store['contact']; ?>" placeholder="" id="" name="contact">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">营业时间:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="<?php echo $store['open_time']; ?>" placeholder="" id="" name="open_time">
            </div>
        </div>

    </form>
</article>
<!--包含尾部文件-->
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
<script type="text/javascript" src="/__STATIC__/admin/hui/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/__STATIC__/admin/hui/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/__STATIC__/admin/hui/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script>

    var SCOPE = {

    }
</script>
<script>
    $(function(){
        var ue = UE.getEditor('editor');
    });
</script>
</body>
</html>