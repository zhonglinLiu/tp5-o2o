<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:62:"F:\study\o2o\public/../application/index\view\lists\index.html";i:1490763025;s:64:"F:\study\o2o\public/../application/index\view\public\header.html";i:1490779098;s:61:"F:\study\o2o\public/../application/index\view\public\nav.html";i:1491751010;}*/ ?>
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
<div class="page-body">
    <div class="filter-bg">
        <div class="filter-wrap">
            <div class="w-filter-ab-test">
                <div class="w-filter-top-nav clearfix" style="margin:12px">


                </div>

                <div class="filter-wrapper">
                    <div class="normal-filter ">
                        <div class="w-filter-normal-ab  filter-list-ab">
                            <h5 class="filter-label-ab">分类</h5>
                            <span class="filter-all-ab">
                                    <a class="w-filter-item-ab  item-all-auto-ab" href="<?php echo url('lists/index'); ?>" ><span class="item-content filter-active-all-ab ">全部</span></a>
                                </span>
                            <div class="j-filter-items-wrap-ab filter-items-wrap-ab">
                                <div class="j-filter-items-ab filter-items-ab filter-content-ab">
                                    <a class="w-filter-item-ab"><span class="item-content">今日新单</span></a>
                                    <?php if(is_array($cates) || $cates instanceof \think\Collection || $cates instanceof \think\Paginator): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                    <a class="w-filter-item-ab" href="<?php echo url('lists/index',['id'=>$key]); ?>" ><span class="item-content <?php if($parent_id == $key): ?>filter-active-all-ab<?php endif; ?> "><?php echo $v['name']; ?></span></a>
                                   <?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="filter-wrapper">
                    <div class="normal-filter ">
                        <div class="w-filter-normal-ab  filter-list-ab">
                            <h5 class="filter-label-ab">子分类</h5>
                            <span class="filter-all-ab">

                                </span>
                            <div class="j-filter-items-wrap-ab filter-items-wrap-ab">
                                <div class="j-filter-items-ab filter-items-ab filter-content-ab">
                                    <a class="w-filter-item-ab"><span class="item-content">今日新单</span></a>
                                    <?php if(is_array($listCates) || $listCates instanceof \think\Collection || $listCates instanceof \think\Paginator): $i = 0; $__LIST__ = $listCates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                    <a class="w-filter-item-ab" href="<?php echo url('lists/index',['se_category_id'=>$v['id']]); ?>"><span class="item-content <?php if($cateid == $v['id']): ?>filter-active-all-ab<?php endif; ?> "><?php echo $v['name']; ?></span></a>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="w-sort-bar">
                <div class="bar-area" style="position: relative; left: 0px; margin-left: 0px; margin-right: 0px; margin-top: 0px; top: 0px;">
                        <span class="sort-area">
                            <a href="<?php echo url('lists/index',['order'=>'order_default','id'=>$cateid]); ?>"  class="sort-default <?php if($orderflog == "order_default"): ?>sort-default-active<?php endif; ?>">默认</a>
                            <a href="<?php echo url('lists/index',['order'=>'order_sale','id'=>$cateid]); ?>" class="sort-item sort-down <?php if($orderflog == "order_sale"): ?>sort-default-active<?php endif; ?>" title="点击按销量降序排序">销量↓</a>
                            <a href="<?php echo url('lists/index',['order'=>'order_price','id'=>$cateid]); ?>"   class="sort-item price-default price <?php if($orderflog == "order_price"): ?>sort-default-active<?php endif; ?>" title="点击按价格降序排序">价格↓</a>

                            <a href="<?php echo url('lists/index',['order'=>'order_time','id'=>$cateid]); ?>"  class="sort-item sort-up <?php if($orderflog == "order_time"): ?>sort-default-active<?php endif; ?>" title="发布时间由近到远">最新发布↑</a>
                        </span>

                </div>
            </div>
            <ul class="itemlist eight-row-height">
                <?php if(is_array($deals) || $deals instanceof \think\Collection || $deals instanceof \think\Paginator): $i = 0; $__LIST__ = $deals;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>

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
                                    安贞 六里桥 丽泽桥 安定门 劲松 昌平镇 航天桥 通州区 通州北苑
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
                                <div class="collected">精选</div>
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
    </div>
    <?php echo renderPagination($deals); ?>
    <div class="content-wrap">共<span style="color: #ff4883"><?php echo $total; ?></span>条</div>
</div>

<div class="footer-content">
    <div class="copyright-info">

    </div>
</div>
<script>
    $(".tab-item-wrap").click(function(){
        var index = $(".tab-item-wrap").index(this);
        $(".tab-item-wrap").removeClass("selected");
        $(".district-cont-wrap").css({display: "none"});
        $(this).addClass("selected");
        $(".district-cont-wrap").eq(index).css({display: "block"});
    });

    $(".sort-area a").click(function(){
        $(".sort-area a").removeClass("sort-default-active").css({color: "#666"});
        $(this).addClass("sort-default-active").css({color: "#ff4883"});
    });
</script>
</body>
</html>