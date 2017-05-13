<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:62:"F:\study\o2o\public/../application/index\view\index\index.html";i:1491749327;s:64:"F:\study\o2o\public/../application/index\view\public\header.html";i:1490779098;s:61:"F:\study\o2o\public/../application/index\view\public\nav.html";i:1491751010;}*/ ?>
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
                <li><a href="<?php echo url('index/user/logout'); ?>">退出登录</a></li>
                <li>欢迎您,<a href="javascript:;" ><?php echo $user->username; ?></a></li>
                <?php else: ?>
                <li><a href="<?php echo url('user/register'); ?>">注册</a></li>

                <li><a href="<?php echo url('user/login'); ?>">登录</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <div class="search">
        <img src="/__STATIC__/index/image/logo.png" />
        
    </div>

    <div class="nav-bar-header">
        <div class="nav-inner">
            <ul class="nav-list">
                <li class="nav-item">
                    <span class="item">全部分类</span>
                    <div class="left-menu">
                        <?php if(is_array($cates) || $cates instanceof \think\Collection || $cates instanceof \think\Paginator): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
                        <div class="level-item">
                            <div class="first-level">
                                <dl>
                                    <dt class="title"><a href="<?php echo url('lists/index',['id'=>$key]); ?>" target="_blank"><?php echo $cate['name']; ?></a></dt>
                                    <?php if(is_array($cate['child']) || $cate['child'] instanceof \think\Collection || $cate['child'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($cate['child']) ? array_slice($cate['child'],0,2, true) : $cate['child']->slice(0,2, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                    <dd><a href="<?php echo url('lists/index',['se_category_id'=>$v['id']]); ?>" target="_blank" class=""><?php echo $v['name']; ?></a></dd>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </dl>
                            </div>
                            <div class="second-level">
                                <div class="section">
                                    <div class="section-item clearfix no-top-border">
                                        <h3>热门分类</h3>
                                        <ul>
                                            <?php if(is_array($cate['child']) || $cate['child'] instanceof \think\Collection || $cate['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $cate['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                            <li><a target="_blank" href="<?php echo url('lists/index',['se_category_id'=>$v['id']]); ?>" class="hot"><?php echo $v['name']; ?></a></li>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </ul>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>

                    </div>
                </li>
                <li class="nav-item"><a class="item first <?php if($cateid == -1): ?> active<?php endif; ?>">首页</a></li>
                <?php if(is_array($cates) || $cates instanceof \think\Collection || $cates instanceof \think\Paginator): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
                <li class="nav-item"><a class="item <?php if($cateid == $key): ?>active<?php endif; ?>" href="<?php echo url('lists/index',['id'=>$key]); ?>" target="_blank"><?php echo $cate['name']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="top-container">
            <div class="mid-area">
                <div class="slide-holder" id="slide-holder">
                    <a href="#" class="slide-prev"><i class="slide-arrow-left"></i></a>
                    <a href="#" class="slide-next"><i class="slide-arrow-right"></i></a>

                    <ul class="slideshow">
                        <?php if(is_array($featured["0"]) || $featured["0"] instanceof \think\Collection || $featured["0"] instanceof \think\Paginator): $i = 0; $__LIST__ = $featured["0"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo $v['url']; ?>" class="item-large"><img class="ad-pic" src="<?php echo $v['image']; ?>" /></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <div class="list-container">
                    
                </div>
            </div>
        </div>
        <div class="right-sidebar">
            <div class="right-ad">
                <ul class="slidepic">
                    <?php if(is_array($featured["1"]) || $featured["1"] instanceof \think\Collection || $featured["1"] instanceof \think\Paginator): $i = 0; $__LIST__ = $featured["1"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <li><a href="<?php echo $v['url']; ?>"><img src="<?php echo $v['image']; ?>" /></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            
        </div>
        <div class="content-container">
            <div class="no-recom-container">
                <div class="floor-content-start">
                    <?php if(is_array($goods) || $goods instanceof \think\Collection || $goods instanceof \think\Paginator): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?>
                    <div class="floor-content">

                        <div class="floor-header">
                            <h3><?php echo $good['topCates']['name']; ?></h3>
                            <ul class="reco-words">
                                <?php if(is_array($good['cates']) || $good['cates'] instanceof \think\Collection || $good['cates'] instanceof \think\Paginator): $i = 0; $__LIST__ = $good['cates'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
                                <li><a href="<?php echo url('lists/index',['se_category_id'=>$cate['id']]); ?>" target="_blank"><?php echo $cate['name']; ?></a></li>

                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                <li><a class="no-right-border no-right-padding" target="_blank">全部<span class="all-cate-arrow"></span></a></li>
                            </ul>
                        </div>
                        <ul class="itemlist eight-row-height">
                            <?php if(is_array($good["goods"]) || $good["goods"] instanceof \think\Collection || $good["goods"] instanceof \think\Paginator): $i = 0; $__LIST__ = $good["goods"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <li class="j-card">
                                <a>
                                    <div class="imgbox">
                                        <ul class="marketing-label-container">
                                            <li class="marketing-label marketing-free-appoint"></li>
                                        </ul>
                                        <div class="range-area">
                                            <div class="range-bg"></div>
                                            <div class="range-inner">
                                                <span class="white-locate"></span>

                                            </div>
                                        </div>
                                        <div class="borderbox">
                                            <img src="<?php echo $v['image']; ?>" />
                                        </div>
                                    </div>
                                </a>
                                <div class="contentbox">
                                    <a href="<?php echo url('detail/index',['id'=>$v['id']]); ?>" target="_blank">
                                        <div class="header">
                                            <h4 class="title ">【<?php echo getCommonUseStores($v['location_ids']); ?>店通用】<?php echo $v['name']; ?></h4>
                                        </div>
                                    </a>
                                    <div class="add-info"></div>
                                    <div class="pinfo">
                                        <span class="price"><span class="moneyico">¥</span><?php echo $v['origin_price']; ?></span>
                                        <span class="ori-price">价值<span class="price-line">¥<span><?php echo $v['current_price']; ?></span></span></span>
                                    </div>
                                    <div class="footer">
                                        <span class="comment">4.6分</span><span class="sold">已售<?php echo $v['buy_count']; ?></span>
                                        <div class="bottom-border"></div>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>

                        </ul>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-content">
        <div class="copyright-info">
            
        </div>
    </div>

    <script>
        var width = 800 * $("#slide-holder ul li").length;
        $("#slide-holder ul").css({width: width + "px"});

        //轮播图自动轮播
        var time = setInterval(moveleft,5000);

        //轮播图左移
        function moveleft(){
            $("#slide-holder ul").animate({marginLeft: "-737px"},600, function () {
                $("#slide-holder ul li").eq(0).appendTo($("#slide-holder ul"));
                $("#slide-holder ul").css("marginLeft","0px");
            });
        }

        //轮播图右移
        function moveright(){
            $("#slide-holder ul").css({marginLeft: "-737px"});
            $("#slide-holder ul li").eq(($("#slide-holder ul li").length)-1).prependTo($("#slide-holder ul"));
            $("#slide-holder ul").animate({marginLeft: "0px"},600);
        }

        //右滑箭头点击事件
        $(".slide-next").click(function () {
            clearInterval(time);
            moveright();
            time = setInterval(moveleft,5000);
        });

        //左滑箭头点击事件
        $(".slide-prev").click(function () {
            clearInterval(time);
            moveleft();
            time = setInterval(moveleft,5000);
        });
    </script>
</body>
</html>