<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:60:"F:\study\o2o\public/../application/index\view\pay\index.html";i:1491040497;s:64:"F:\study\o2o\public/../application/index\view\public\header.html";i:1490779098;s:61:"F:\study\o2o\public/../application/index\view\public\top.html";i:1490767783;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="/__STATIC__/index/css/base.css" />
    <link rel="stylesheet" href="/__STATIC__/index/css/common.css" />
    <link rel="stylesheet" href="/__STATIC__/index/css/<?php echo $controller; ?>.css" />
    <script type="text/javascript" src="/__STATIC__/index/js/html5shiv.js"></script>
    <script type="text/javascript" src="/__STATIC__/index/js/respond.min.js"></script>
    <script type="text/javascript" src="/__STATIC__/index/js/jquery-1.11.3.min.js"></script>
    <script src="/__STATIC__/js/dialog/layer.js"></script>
    <script src="/__STATIC__/js/dialog.js"></script>

</head>

<body>
<div class="header-bar">
    <div class="header-inner">
        <ul class="father">
            <li><a><?php echo $city; ?></a></li>
            <li>|</li>
            <li class="city">
                <a>切换城市<span class="arrow-down-logo"></span></a>
                <div class="city-drop-down">
                    <h3>热门城市</h3>
                    <ul class="son">
                        <?php if(is_array($citys) || $citys instanceof \think\Collection || $citys instanceof \think\Paginator): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo url('index/index',['cityName'=>$v['name'],'city_id'=>$v['id']]); ?>"><?php echo $v['name']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>

                </div>
            </li>
            <li> <a href="<?php echo url('bis/login/index'); ?>">商户中心</a> </li>
            <?php if($user != ""): ?>
            <li><a href="<?php echo url('user/logout'); ?>">退出登录</a></li>
            <li>欢迎您,<a href="javascript:;" ><?php echo $user->username; ?></a></li>
            <?php else: ?>
            <li><a href="<?php echo url('user/register'); ?>">注册</a></li>

            <li><a href="<?php echo url('user/login'); ?>">登录</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<div style="margin: auto;width:200px;">
    <p style="text-align: center; margin-top:20px; font-size:20px ;" >请扫描支付</p>
    <img width="200" height="200" src="/upload/12.jpg"/>
</div>
</body>
<script >
    var time = 3000;
    setInterval(function () {
      if(time>=0){
          time-=1000;
      }else{
          window.location.href='<?php echo url("pay/notify",["deal_id"=>$deal_id,"out_trade_no"=>$out_trade_no]); ?>';
      }
    },1000)
</script>
</html>