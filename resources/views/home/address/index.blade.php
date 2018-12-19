@extends('home.layouts.master')
@section('content')
    <div id="content" style="background: #f5f5f5;overflow: hidden">
        <div class="ordercontent main">
            @include('home.personal_center.layouts.slider')
            <div class="orderright">
                <div class="orderlist">
                    <h2>地址管理</h2>
                    <div style="padding: 30px">
                        <table class="layui-table" lay-size="sm">
                            <colgroup>
                                <col >
                                <col >
                                <col>
                            </colgroup>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>地址</th>
                                <th>详细地址</th>
                                <th>添加时间</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($addresses as $address)
                                <tr>
                                    <td>{{$address['id']}}</td>
                                    <td>{{$address['province']}}/{{$address['city']}}/{{$address['district']}}</td>
                                    <td>{{$address['detail']}}</td>
                                    <td>{{$address->created_at->format('Y-m-d')}}</td>
                                    <td>
                                        <div class="layui-btn-group">
                                            @if($address['is_default']==1)
                                                <button class="layui-btn  layui-btn-sm">默认地址</button>
                                            @else
                                                <a href="{{route('home.address.show',$address)}}" class="layui-btn layui-btn-primary layui-btn-sm">设为默认</a>
                                            @endif
                                            <a href="{{route('home.address.edit',$address)}}" class="layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon"></i></a>
                                            <button onclick="del(this)" class="layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon"></i></button>
                                                <form action="{{route('home.address.destroy',$address)}} " method="post">
                                                    @csrf @method('DELETE')
                                                </form>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <a href="{{route('home.address.create')}}" class="layui-btn">添加地址</a>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.message')
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
        function del (obj) {
            //alert(1)
            $(obj).next('form').submit();
        }
    </script>

@endpush
