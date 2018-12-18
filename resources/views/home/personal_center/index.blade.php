@extends('home.layouts.master')
@section('content')
    <div id="content" style="background: #f5f5f5;overflow: hidden">
        <div class="ordercontent main">
            @include('home.personal_center.layouts.slider')
            <div class="orderright">
                <div class="orderlist">
                    <h2>我的订单</h2>
                    <div class="carshop">
                        <div class="cartitle">
                            <div class="carname">订单编号</div>
                            <div class="carmoney">订单时间</div>
                            <div class="carnum">数量(件)</div>
                            <div class="carcount">小计</div>
                            <div class="carhandle">操作</div>
                        </div>
                        <div class="shopcontent">
                            <div class="shopname">
                                <p>
                                    <a href="#">小米手机5 全网通标准版 白色 32GB</a>
                                </p>
                            </div>
                            <div class="shopmoney">2000元</div>
                            <div class="shopnum">
                                2
                            </div>
                            <div class="shopcount">2000元</div>
                            <div class="shophandle"><span>x</span></div>
                        </div>
                    </div>
                    <div class="jiesuan">
                        <div class="gongji">共计<span>10</span>件商品</div>
                        <div class="heji">合计<span>100.00</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset ('org/home')}}/css/account.css"/>
@endpush
@push('js')
    <script src="{{asset ('org/home')}}/js/list.js" type="text/javascript" charset="utf-8"></script>
@endpush
