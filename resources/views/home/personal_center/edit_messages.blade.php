@extends('home.layouts.master')
@section('content')
    <div id="content" style="background: #f5f5f5;overflow: hidden">
        <div class="ordercontent main">
            @include('home.personal_center.layouts.slider')
            <div class="orderright">
                <div class="orderlist">
                    <h2>我的个人信息</h2>
                    <div style="padding: 30px">
                        <form class="layui-form" action="{{route('user.update',auth()->user())}}" method="post">
                            @csrf @method('PUT')
                            <div class="layui-form-item">
                                <label class="layui-form-label">用户昵称</label>
                                <div class="layui-input-block">
                                    <input type="text" name="name" placeholder="请输入用户昵称" value="{{auth()->user()->name}}" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item" id="distpicker">
                                <label class="layui-form-label">选择地址</label>
                                <div class="layui-input-inline">
                                    <select name="province" lay-filter="a" id="a"></select>
                                </div>
                                <div class="layui-input-inline">
                                    <select name="city" lay-filter="b" id="b"></select>
                                </div>
                                <div class="layui-input-inline">
                                    <select name="district" lay-filter="c" id="c"></select>
                                </div>
                            </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">详细地址</label>
                                <div class="layui-input-block">
                                    <textarea placeholder="" name="detail" value="{{auth()->user()->detail}}" class="layui-textarea">{{auth()->user()->detail}}</textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">用户邮箱</label>
                                <div class="layui-input-block">
                                    <input type="text" name="email" value="{{auth()->user()->email}}"  class="layui-input ">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <label class="layui-form-label">手机号</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="phone" value="{{auth()->user()->mobile}}" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-inline">
                                    <label class="layui-form-label">请选择生日</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="birthday" value="{{auth()->user()->birthday}}" id="date" placeholder="yyyy-MM-dd" class="layui-input">
                                    </div>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">性别</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="sex" value="男" title="男" checked="">
                                    <input type="radio" name="sex" value="女" title="女">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset ('org/home')}}/css/account.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset ('org/layui')}}/css/layui.css"/>
@endpush
@push('js')
    {{--三级城市联动--}}
    <script src="https://cdn.bootcss.com/distpicker/2.0.5/distpicker.min.js"></script>
    <script src="{{asset ('org/home')}}/js/list.js" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('org/layui/layui.js')}}"></script>
    <script>
        //城市联动
        $("#distpicker").distpicker({
            province: "{{auth()->user()->province?:'湖北省'}}",
            city: '{{auth()->user()->city?:'天门市'}}',
            district: '{{auth()->user()->district?:'竟陵街道'}}'
        });
        layui.use(['form', 'layedit', 'laydate'], function () {
            var form = layui.form
                , layer = layui.layer
                , laydate = layui.laydate;
            //日期
            laydate.render({
                elem: '#date'
            });
            form.on('select(a)', function (data) {
                console.log(data)
                $("#a").val(data.value).change();
                form.render();
            })

            form.on('select(b)', function (data) {
                $("#b").val(data.value).change();
                form.render();
            })

            form.on('select(c)', function (data) {
                $("#c").val(data.value).change();
                form.render();
            })
        });

    </script>
@endpush
