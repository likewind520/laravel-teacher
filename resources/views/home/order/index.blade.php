@extends('home.layouts.master')
@section('content')
    <div class="body-center">
        <div class="center-content">
            <!--头部开始-->
            <div class="content-header">
                <p>收获地址  <span>温馨提示：为了保证您的权益，防止黄牛倒卖，订单进入正在配货状态将不能修改收货地址和发票信息！</span></p>
            </div>
            <!--头部结束-->
            <!--地址选择开始-->
            <div class="content-address">
                <div class="consignee-item">
                    <span class="radio-img pitchOn"></span>
                    <label for="adress1" class="radio">
                        <input type="radio" name="adress" id="adress1" class="radio-select" value=""/><span class="e-name">小明</span>，<span class="city">北京 北京市 朝阳区 </span><span class="city-particular">孙河 顺白路12号 后盾it教育</span>，<span class="codeNumber">15600266727</span>
                    </label>
                    <span class="compile"><a class="copyreader" href="{{route('home.personal_center')}}">编辑</a></span>
                </div>
                <div class="consignee-item">
                    <span class="radio-img"></span>
                    <label for="adress2" class="radio">
                        <input type="radio" name="adress" id="adress2" class="radio-select" value=""/><span class="e-name">大胖</span>，<span class="city">北京 北京市 朝阳区 </span><span class="city-particular">孙河 顺白路12号 后盾it教育</span>，<span class="codeNumber">15600266727</span>
                    </label>
                    <span class="compile"><a class="copyreader" href="javascript:;">编辑</a></span>
                </div>

            </div>
            <!--地址选择结束-->


            <!--选项开始-->
            <div class="options">
                <div class="options-all">
                    <div class="payment options-public">
                        <h3>支付方式</h3>
                    </div>
                    <div class="consignee-item new-ress">
                        <span class="radio-img pitchOn"></span>
                        <label for="payment" class="radio w122"><input type="radio" name="payment" id="payment" class="radio-select"  value=""/>微信支付</label>
                    </div>
                </div>

                <div class="options-all invoice">
                    <div class=" options-public">
                        <h3>发票信息</h3>
                    </div>
                    <div class="box-all" style="overflow: hidden;">
                        <div class="consignee-item new-ress left">
                            <span class="radio-img pitchOn"></span>
                            <label for="invoice" class="radio w122 no"><input type="radio" name="invoice" id="invoice" class="radio-select "  value=""/>不开发票</label>
                        </div>
                        <div class="consignee-item new-ress left">
                            <span class="radio-img "></span>
                            <label for="invoice1" class="radio w122 yes"><input type="radio" name="invoice" id="invoice1" class="radio-select "  value=""/>普通发票</label>

                        </div>
                    </div>
                    <div class="con">
                        <div class="text">发票内容：购买商品明细</div>
                        <div class="text">发票抬头：请确认单位名称正确，以免因名称错误耽搁您的报销。</div>
                        <div class="box-all" style="overflow: hidden; margin-top: 10px;">
                            <a href="javascript:;" class="geren tongyong active">个人</a>
                            <a href="javascript:;" class="danwei tongyong">单位</a>
                        </div>
                        <div class="danweiname" >
                            <div class="text">单位名称：</div>
                            <input type="text" name="danweiname" id="danweiname" value="" />
                        </div>
                    </div>
                </div>

            </div>
            <!--选项结束-->
            <div class="options-all  goods">
                <div class="qingdan options-public" style="border: none;">
                    <h3>商品清单</h3>
                </div>
                <div class="goodsList">
                    <div class="title">
                        <ul>
                            <li class="l1">商品名称</li>
                            <li class="l2">单价</li>
                            <li class="l3">数量</li>
                            <li class="l4">合计</li>
                        </ul>
                    </div>
                </div>

                <div class="goods-cont">
                    <ul>
                        <li style="padding: 13px;">
                            <div class="gc1">
                                <img src="images/kouzhao.jpg"/>
                                <span>原森态 主动送风式防护口罩 防雾霾pm2.5（钛晶灰）</span>
                            </div>
                            <div class="gc2">
                                ¥
                                <span>298.00</span>
                            </div>
                            <div class="gc3">
                                X
                                <span>1</span>
                            </div>
                            <div class="gc4">
                                ¥
                                <span>298.00</span>
                            </div>
                        </li>
                        <li style="padding: 13px;">
                            <div class="gc1">
                                <img src="images/kouzhao.jpg"/>
                                <span>原森态 主动送风式防护口罩 防雾霾pm2.5（钛晶灰）</span>
                            </div>
                            <div class="gc2">
                                ¥
                                <span>298.00</span>
                            </div>
                            <div class="gc3">
                                X
                                <span>1</span>
                            </div>
                            <div class="gc4">
                                ¥
                                <span>298.00</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <!--总计-->
                <div class="zongji">
                    <ul>
                        <li>
                            共<span class="color">2</span>件
                        </li>
                        <li style="margin-top: 15px;">
                            <h3>应付总金额：<span class="color">1416.00</span>元</h3>
                        </li>
                    </ul>
                </div>

                <!--确认地址-->
                <div class="mailTo">
                    <p>寄送至：<span class="m-city">北京 北京市 朝阳区 </span><span class="m-particular">孙河 顺白路12号 后盾it教育</span></p>
                    <p><span class="m-name">贾博雨</span> (收件人) <span class="m-number">15600266727</span> </p>
                </div>
                <div class="" style="overflow: hidden;">
                    <a href="" class="liji">立即下单</a>
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
