@extends('home.layouts.master')
@section('content')
    <div class="body-center">
        <div class="center-content">
            <!--头部开始-->
            <div class="content-header">
                <p>恭喜您的订单提交成功 </p>
            </div>
            <!--选项结束-->
            <div class="options-all  goods">
                <div>
                    <p>订单号:{{$order['number']}}</p>
                    <p>总价:¥ {{$order['total_price']}}</p>
                    @foreach($order->orderDetail as $v)
                        <p>{{$v['title']}}</p>
                    @endforeach
                </div>
                <div class="qingdan options-public" style="border: none;">
                    <h3></h3>
                </div>
                <div class="goodsList">
                    <div class="title" style="text-align: center;color: #fff">
                        请您使用微信扫码进行支付
                    </div>
                </div>
                <br>
                <div class="goods-cont" style="text-align: center;border-bottom: none">
                    <img src="{{asset('org/home/images/wehchat_qrcode.jpg')}}" width="200" alt="">
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
    <script src="{{asset ('org/home')}}/js/account.js" type="text/javascript" charset="utf-8"></script>
@endpush
