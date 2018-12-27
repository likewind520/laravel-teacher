<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{hd_config('website.site_name')}}</title>
    <script src="{{asset ('org/home')}}/js/jquery-1.10.1.min.js" type="text/javascript" charset="utf-8"></script>
    @stack('css')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>
</head>

<body>
<!--头部开始-->
<div id="top">
    <!--头部灰条就开始-->
    <div class="topbox">
        <div class="main">
            <div class="topleft fl">
                <a href="/">欢迎来到{{hd_config('website.site_name')}}</a>
            </div>
            <div class="topright fr">
                <div class="login fl">
                    @auth()
                        <a href="{{route('home.personal_center')}}">{{auth ()->user ()->name}}</a>
                        <a href="{{route ('logout',['from'=>url ()->full()])}}">注销</a>
                    @else
                        <a href="{{route ('login',['from'=>url ()->full()])}}">登录</a>
                        <a href="{{route ('register')}}">注册</a>
                    @endauth
                </div>
                @auth()
                    <span class="fl">|</span>
                    <div class="fcode fl">
                        <a href="{{route('home.personal_center')}}">我的订单</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
    <!--头部灰条结束-->

    <!--logo区域开始-->
    <div class="logoRegion">
        <div class="main">
            <div class="logo">
                <a href="/"><img src="{{asset ('org/home')}}/images//360logo.png"/></a>
            </div>
            <div class="seachRegion">
                <div class="seach fl">
                    <form action="{{route('home.search')}}">
                        <input type="text" name="kwd" class="seachtxt fl" value="{{request()->query('kwd')}}" placeholder="搜索..."/>
                        <button type="submit" class="btn" value=""></button>
                    </form>
                    <p class="searchkey">
                        @foreach($_keywords as $keyword)
                            <a href="{{route('home.search',['kwd'=>$keyword['kwd']])}}">{{$keyword['kwd']}}</a>
                        @endforeach
                    </p>
                </div>
                <?php
                $_carts=\App\Models\Cart::where('user_id',auth()->id())->latest()->limit(4)->get();
                ?>
                <div class="topshopcart fr">
                    <a href="{{route('home.cart.index')}}" class="header-cart">
                        <i></i>
                        我的购物车
                        @auth()
                            <span class="cart-size">({{\App\Models\Cart::where('user_id',auth()->id())->count()}})</span></a>
                    @else
                        <span class="cart-size">({{\App\Models\Cart::where('user_id',auth()->id())->count()}})</span></a>
                    @endauth
                    @auth()
                        <div class="cart-tips" style="overflow: hidden;height: auto">
                            <ul style="overflow: hidden;padding: 10px;">
                                @foreach($_carts as $cart)
                                    <li>
                                        <div style="background: white;overflow: hidden">
                                            <div class="gc1" style="overflow: hidden">
                                                <p style="float: left">
                                                <img style="width: 80px" src="{{$cart['pic']}}"/>
                                                </p>
                                                <p style="float: left ;width: 200px;word-break: break-all; text-overflow: ellipsis;display: -webkit-box;-webkit-box-orient: vertical;overflow: hidden;-webkit-line-clamp: 1;">{{$cart['title']}}</p>
                                                <p style="float: left ; color: red; width: 80px;word-break: break-all; text-overflow: ellipsis;display: -webkit-box;-webkit-box-orient: vertical;overflow: hidden;-webkit-line-clamp: 1;">¥ {{$cart['price']}}元</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                    <div class="cart-tips">
                        请
                        <a href="{{route ('login',['from'=>url ()->full()])}}"><span style="color: #0b67cd">登录</span></a>后查看您的购物车。
                    </div>
                    @endauth
                </div>
            </div>

            {{--购物车 网上教程示例--}}
            {{--<style>--}}
            {{--#testDIV{--}}
            {{--border:1px solid #ddd;--}}
            {{--width: 100px;--}}
            {{--word-break: break-all;--}}
            {{--text-overflow: ellipsis;--}}
            {{--display: -webkit-box; /** 将对象作为伸缩盒子模型显示 **/--}}
            {{---webkit-box-orient: vertical; /** 设置或检索伸缩盒对象的子元素的排列方式 **/--}}
            {{---webkit-line-clamp: 3; /** 显示的行数 **/--}}
            {{--overflow: hidden;  /** 隐藏超出的内容 **/--}}
            {{--}--}}
            {{--</style>--}}

            {{--<div id="testDIV" >--}}
             {{--点击啦啦啦啦啦了绿绿绿啦啦啦啦啦了绿绿的哈哈哈哈哈jk道具哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈--}}
         {{--</div>--}}
            {{--购物车 网上教程示例--}}
        </div>
    </div>
    <!--logo区域结束-->
    <!--导航开始-->
    <div class="navbox">
        <div class="main">
            <h5 class="fl"><a href=""><i></i>全部智能酷品</a></h5>
            <ul class="menu fl">
                @foreach($_categories as $category)
                    <li class="menulist">
                        <a href="{{route ('home.list',['list'=>$category['id']])}}">{{$category['name']}}</a>
                        @if($category->good->count() != 0)
                            <div class="menuHiden">
                                <ul class="product">
                                    @foreach($category->good()->limit(6)->get() as $good)
                                        <li>
                                            <a href="{{route ('home.content',['content'=>$good['id']])}}">
                                                <img src="{{$good->list_pic}}" alt=""/>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        {{--左侧二级菜单--}}
        @yield('menu')
    </div>
    <!--导航结束-->
    <div class="clear"></div>
    <!--banner开始 轮播图-->
    @yield('flash')
    <!--banner结束-->
</div>
<!--头部结束-->
<!--中间开始-->
@yield('content')
<!--中间结束-->
<!--尾部开始-->
{{--<div class="mod-footer">--}}
    {{--<div class="foot-bannerw">--}}
        {{--<div class="foot-banner clearfix">--}}
            {{--<div class="banner-item">--}}
                {{--<a href="#" target="_blank" data-monitor="home_foot_days7"><i class="icon1">7</i>7天无理由退货</a>--}}
            {{--</div>--}}
            {{--<div class="banner-item">--}}
                {{--<a href="#" target="_blank" data-monitor="home_foot_days15"><i class="icon2">15</i>15天免费换货</a>--}}
            {{--</div>--}}
            {{--<div class="banner-item"><i class="icon3">包</i>满99元包邮</div>--}}
            {{--<div class="banner-item">--}}
                {{--<a href="#" target="_blank" data-monitor="home_foot_moblie"><i class="icon4">服</i>手机特色服务</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="foot-containerw">--}}
        {{--<div class="foot-container clearfix">--}}
            {{--<dl class="foot-con"> <dt data-monitor="home_foot_freshman">帮助中心 </dt>--}}
                {{--<dd data-monitor="home_help_freshman">--}}
                    {{--<a target="_blank" href="#" rel="nofollow">用户注册</a>--}}
                {{--</dd>--}}
                {{--<dd>--}}
                    {{--<a target="_blank" href="#" rel="nofollow">用户登录与密码找回</a>--}}
                {{--</dd>--}}
                {{--<dd>--}}
                    {{--<a target="_blank" href="#" rel="nofollow">购买指南</a>--}}
                {{--</dd>--}}
                {{--<dd>--}}
                    {{--<a target="_blank" href="#" rel="nofollow">支付方式</a>--}}
                {{--</dd>--}}
                {{--<dd>--}}
                    {{--<a target="_blank" href="#" rel="nofollow">配送与说明</a>--}}
                {{--</dd>--}}
            {{--</dl>--}}
            {{--<dl class="foot-con"> <dt data-monitor="home_foot_help">售后服务 </dt>--}}
                {{--<dd data-monitor="home_help_help">--}}
                    {{--<a target="_blank" href="#">7 日无理由退货</a>--}}
                {{--</dd>--}}
                {{--<dd>--}}
                    {{--<a target="_blank" href="#" rel="nofollow">质量问题 15 日内换货</a>--}}
                {{--</dd>--}}
                {{--<dd>--}}
                    {{--<a target="_blank" href="#" rel="nofollow">保修条款</a>--}}
                {{--</dd>--}}
                {{--<dd>--}}
                    {{--<a target="_blank" href="#" rel="nofollow">服务流程</a>--}}
                {{--</dd>--}}
                {{--<dd>--}}
                    {{--<a target="_blank" href="#" rel="nofollow">安迷之家</a>--}}
                {{--</dd>--}}
            {{--</dl>--}}
            {{--<dl class="foot-con"> <dt data-monitor="home_foot_guide">特色服务 </dt>--}}
                {{--<dd data-monitor="home_help_guide">--}}
                    {{--<a target="_blank" href="#" rel="nofollow">F码通道</a>--}}
                {{--</dd>--}}
                {{--<dd>--}}
                    {{--<a target="_blank" href="#" rel="nofollow">免费试用</a>--}}
                {{--</dd>--}}
                {{--<dd>--}}
                    {{--<a target="_blank" href="#" rel="nofollow">360 生态</a>--}}
                {{--</dd>--}}
                {{--<dd>--}}
                    {{--<a target="_blank" href="#" rel="nofollow">一元夺宝</a>--}}
                {{--</dd>--}}
            {{--</dl>--}}
            {{--<dl class="foot-con"> <dt data-monitor="home_foot_tuiguang">推广合作 </dt>--}}
                {{--<dd data-monitor="home_help_try">--}}
                    {{--<a target="_blank" href="#" rel="nofollow">商品入驻</a>--}}
                {{--</dd>--}}
                {{--<dd>--}}
                    {{--<a target="_blank" href="#" rel="nofollow">大客户采购</a>--}}
                {{--</dd>--}}
            {{--</dl>--}}
            {{--<dl class="foot-con"> <dt data-monitor="home_foot_try">关注360商城 </dt>--}}
                {{--<dd data-monitor="home_help_try">--}}
                    {{--<a target="_blank" href="#" rel="nofollow">360商城大事记</a>--}}
                {{--</dd>--}}
            {{--</dl>--}}

        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="footer-copyright">冰雨商城 ©2016-2018 BYCMS工作室版权所有 京ICP备000001号-43</div>--}}
{{--</div>--}}
<!--尾部结束-->

<!--右边底部返回顶部-->
<div class="slidebar" id="slidebar">
    <ul>
        <li class="topback">
            <a href="javascript:;"></a>
        </li>
    </ul>
</div>
<!--右边底部返回顶部结束-->
<!--左侧楼层开始-->
{{--<div class="floor">--}}
    {{--<ul>--}}
        {{--<li class="on1">--}}
            {{--<a href="javascript:;"><span>1F<br />活动</span></a>--}}
        {{--</li>--}}
        {{--<li class="on2">--}}
            {{--<a href="javascript:;"><span>2F<br />活动</span></a>--}}
        {{--</li>--}}
        {{--<li class="on3">--}}
            {{--<a href="javascript:;"><span>3F<br />活动</span></a>--}}
        {{--</li>--}}
        {{--<li class="on4">--}}
            {{--<a href="javascript:;"><span>4F<br />活动</span></a>--}}
        {{--</li>--}}
        {{--<li class="on5">--}}
            {{--<a href="javascript:;"><span>5F<br />活动</span></a>--}}
        {{--</li>--}}
        {{--<li class="on6">--}}
            {{--<a href="javascript:;"><span>6F<br />活动</span></a>--}}
        {{--</li>--}}
    {{--</ul>--}}
{{--</div>--}}

@stack('js')
@include('layouts.message')

<!--左侧楼层结束-->

</body>

</html>
