<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:63:"F:\study\o2o\public/../application/index\view\detail\index.html";i:1494145396;s:64:"F:\study\o2o\public/../application/index\view\public\header.html";i:1494142426;s:61:"F:\study\o2o\public/../application/index\view\public\nav.html";i:1491751010;}*/ ?>
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
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=kij4hsGAOj7yFzNTBbGQWfY4hL3Z7Yu8"></script>
    <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>

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

<div class="p-detail">
    <div class="p-bread-crumb">
        <div class="w-bread-crumb">
            <ul class="crumb-list">
                <li class="crumb"><a>团购</a><span class="ico-gt">&gt;</span></li>
                <li class="crumb"><a><?php echo $cate['name']; ?></a><span class="ico-gt">&gt;</span></li>
                <li class="crumb crumb-last"><a><?php echo $deal['name']; ?></a></li>
            </ul>
        </div>
    </div>
    <div class="static-hook-real static-hook-id-5"></div>
    <div class="p-item-info">
        <div class="w-item-info">
            <h2><?php echo $bis['name']; ?></h2>
            <div class="item-title">
                <span class="text-main"><?php echo $deal['name']; ?></span>
            </div>
            <div class="ii-images static-hook-real static-hook-id-6">
                <div class="w-item-images">
                    <div class="images-board">
                        <div class="item-status ">
                            <span class="ico-status ico-jingxuan"></span>
                        </div>
                        <img src="<?php echo $deal['image']; ?>" class="item-img-large" />
                    </div>
                    <ul class="images-list clearfix">
                        <li class="images images-last">
                            <img src="<?php echo $deal['image']; ?>" />
                        </li>
                    </ul>
                    <div class="erweima-share-collect">
                        <ul class="item-option clearfix">
                            <li class=" ">

                                <div class="collect-success">

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="ii-intro">
                <div class="w-item-intro">
                    <div class="price-area-wrap static-hook-real static-hook-id-8">
                        <div class="price-area has-promotion-icon">
                            <div class="pic-price-area">
                                <span class="unit">¥</span>
                                <span class="priceNum"><?php echo $deal['current_price']; ?></span>
                            </div>

                            <div class="market-price-area">
                                <div class="price">¥<?php echo $deal['origin_price']; ?></div>
                                <div class="name">价值</div>
                            </div>


                        </div>
                    </div>
                    <div class="static-hook-real static-hook-id-9">
                        <a class="link jingxuan-box" alt="更多精选品牌特惠">
                            <?php if($flog == 1): ?>
                            <div class="box">
                                <div class="jx-update" id="j-jxUpdateTime">
                                    <span>距离开始时间还有</span>
                                    <span class="jx-timerbox"><?php echo $countDown; ?></span>
                                </div>
                            </div>
                            <?php endif; ?>
                        </a>
                    </div>
                    <ul class="ugc-strategy-area static-hook-real static-hook-id-10">
                        <li class="item-bought">
                            <div class="sl-wrap">
                                <div class="sl-wrap-cnt">
                                    <div class="item-bought-num"><span class="intro-strong"><?php echo $deal['buy_count']; ?></span>人已团购</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="buy-panel-wrap">
                        <div class="buy-panel">
                            <div class="validdate-buycount-area static-hook-real static-hook-id-11">
                                <div class="item-countdown-row">
                                    <span class="name">有效期</span>
                                    <span class="value"><?php echo $deal['end_time']; ?></span>
                                </div>
                                <div class="item-buycount-row j-item-buycount-row">
                                    <div class="name">数&nbsp;&nbsp;&nbsp;量</div>
                                    <div class="buycount-ctrl">
                                        <a href="javascript:;" class="j-ctrl ctrl minus disabled"><span class="horizontal"></span></a>
                                        <input type="text" value="1" maxlength="10" autocomplete="off">
                                        <a href="javascript:;" class="ctrl j-ctrl plus "><span class="horizontal"></span><span class="vertical"></span></a>
                                    </div>
                                    <div class="text-wrap">
                                        <span class="left-budget">优惠价剩余20份</span>
                                        <span class="err-wrap j-err-wrap"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="item-buy-area">
                                <div style="float:left" class="static-hook-real static-hook-id-12">
                                    <?php if($flog == 1): ?>
                                    <a href="javascript:;" style="background: #c0c0c0;border:1px solid #c0c0c0" class="btn-buy btn-buy-qrnew j-btn-buy btn-hit">立即抢购</a>
                                    <?php else: ?>
                                    <a href="javascript:;" class="btn-buy btn-buy-qrnew j-btn-buy btn-hit pay_o2o">立即抢购</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-item-info-more">
        <div class="iim-wrapper">
            <div class="spec-nav ">
                <div class="nav-bar"></div>
                <div class="w-spec-nav" style="position: static; top: auto; z-index: auto;">
                    <ul class="sn-list">
                        <li class="spec-nav-current">
                            <i></i><a><span>本单详情</span></a>
                        </li>
                        <li class="">
                            <i></i><a><span>消费提示</span></a>
                        </li>
                        <li class="">
                            <i></i><a><span>商家介绍</span></a>
                        </li>
                    </ul>

                </div>
            </div>
            <ul class="j-info-all">
                <li class="tab">
                    <div class="ia-shop-branch">
                        <div class="w-shop-branch">
                            <h3 class="w-section-header">分店信息</h3>
                            <div class="branch-content">
                                <div class="shop-map">
                                    <div class="w-map">
                                        <!-- <img src="<?php echo url('map/getStatusMap',['position'=>$position]); ?>" /> -->
                                    <iframe src="<?php echo url('detail/map'); ?>" style="border: none; overflow: hidden; " scrolling="no" width="400" height="400" ></iframe>
                                            
                                           
                                        <a class="map-zoom">
                                            <span>查看完整地图</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="branch-detail">
                                    <div>
                                        <div class="w-area-filter">
                                            <label>筛选：</label>
                                            <select name="city" class="af-content"><option value="100010000" selected="">北京市</option></select>
                                            <select name="district" class="af-content">
                                                <option selected="">全部城区</option>
                                                <option value="307">朝阳区</option>
                                                <option value="392">海淀区</option>
                                                <option value="395">丰台区</option>
                                                <option value="408">通州区</option>
                                                <option value="6547">平谷区</option>
                                            </select>
                                        </div>
                                        <div class="branch-list-content">
                                            <div class="w-branch-list">
                                                <ul class="branch-list-content">
                                                    <?php if(is_array($locations) || $locations instanceof \think\Collection || $locations instanceof \think\Paginator): $i = 0; $__LIST__ = $locations;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                                    <li class="branch branch-open">
                                                        <a href="<?php echo url("","",true,false);?>" target="_blank" class="branch-name"><?php echo $v['address']; ?>店</a>
                                                        <p class="branch-tel"><?php echo $v['tel']; ?></p>
                                                        <p class="map-travel">
                                                            <a href="javascript:;" class="map">
                                                                <span class="icon"></span>
                                                                <span class="text">查询地图</span>
                                                            </a>
                                                            <a href="javascript:;" class="travel">
                                                                <span class="icon"></span>
                                                                <span class="text">公交/驾车去这里</span>
                                                            </a>
                                                        </p>
                                                    </li>
                                                   <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ifram"><?php echo $deal['description']; ?></div>
                </li>
                <li class="tab"><div class="ifram"><?php echo $deal['notes']; ?></div></li>
                <li class="tab"><div class="ifram"><?php echo $bis['description']; ?></div></li>
            </ul>
        </div>
    </div>
</div>

<div class="footer-content">
    <div class="copyright-info">
        <div class="site-info">

        </div>
        <div class="icons">

        </div>
        <div style="width:200px;margin:0 auto; padding:20px 0;">

        </div>
    </div>
</div>


<script>

    //校验正整数
    function isNaN(number){
        var reg = /^[1-9]\d*$/;
        return reg.test(number);
    }

    function inputChange(num){
        if(!isNaN(num)){
            $(".buycount-ctrl input").val("1");
        }
        else{
            $(".buycount-ctrl input").val(num);
            if(num == 1){
                $(".buycount-ctrl a").eq(0).addClass("disabled");
            }
            else{
                $(".buycount-ctrl a").eq(0).removeClass("disabled");
            }
        }
    }

    $(".buycount-ctrl input").keyup(function(){
        var num = $(".buycount-ctrl input").val();
        inputChange(num);
    });
    $(".minus").click(function(){
        var num = $(".buycount-ctrl input").val();
        num--;
        inputChange(num);
    });
    $(".plus").click(function(){
        var num = $(".buycount-ctrl input").val();
        num++;
        inputChange(num);
    });



    $(".sn-list li").click(function(){
        var index = $(".sn-list li").index(this)
        $(".sn-list li").removeClass("spec-nav-current");
        $(".j-info-all .tab").css({display: "none"});
        $(this).addClass("spec-nav-current");
        $(".j-info-all .tab").eq(index).css({display: "block"});
    });

    $(".branch").mouseenter(function(){
        $(".branch").removeClass("branch-open").addClass("branch-close");
        $(this).removeClass("branch-close").addClass("branch-open");
    });
    $(".pay_o2o").click(function () {
        var count = $('.buycount-ctrl input').val();
        var id = "<?php echo $deal['id']; ?>";
        var url = "<?php echo url('order/index'); ?>"+'?id='+id+'&count='+count;
        window.open(url);
    })

    $('.map-zoom').click(function(){
         layer.open({
              type: 2,
              title: '百度地图大图',
              shadeClose: true,
              shade: false,
              maxmin: true, //开启最大化最小化按钮
              area: ['893px', '600px'],
              content: "<?php echo url('detail/map'); ?>"
            });
    })


</script>

</body>
</html>


