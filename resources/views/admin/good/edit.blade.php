@extends('admin.layouts.master')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">首页</a></li>
                <li class="breadcrumb-item active">商品管理</li>
            </ol>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-b-0">
            <h4 class="card-title">商品管理</h4>
        </div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item">
                <a class="nav-link " href="{{route('admin.good.index')}}">
                    <span class="hidden-sm-up"><i class="ti-home"></i></span>
                    <span class="hidden-xs-down">商品列表</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{route('admin.good.create')}}">
                    <span class="hidden-sm-up"><i class="ti-user"></i></span> <span
                        class="hidden-xs-down">编辑商品</span>
                </a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="card-header"></div>
            <div class="card-body">
                <form action="{{route('admin.good.update',$good)}}" method="post"
                      class="form-horizontal ">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <!--/row-->
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">商品名称</label>
                                <div class="col-md-9">
                                    <input type="text" placeholder="请输入商品名称" name="title" value="{{$good['title']}}"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">商品价格</label>
                                <div class="col-md-9">
                                    <input type="number" placeholder="请输入商品价格" name="price" value="{{$good['price']}}"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">所属分类</label>
                                <div class="col-md-9">
                                    <select name="category_id" class="form-control custom-select"
                                            data-placeholder="Choose a good"
                                            tabindex="1">
                                        <option value="">请选择分类</option>
                                        @foreach($categories as $v)
                                            <option @if( $v['id'] ==$good['category_id'] ) selected
                                                    @endif value="{{$v['id']}}">{{$v['_name']}}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-control-feedback"> 请选择父级商品</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">商品列表图片</label>
                                <div class="col-md-9">
                                    <div class="layui-upload-drag" id="test10">
                                        @if(old ('list_pic'))
                                            <img src="{{old ('list_pic')}}" width="50" alt="">
                                            <input type="hidden" name="list_pic" value="{{old ('list_pic')}}">
                                        @else
                                            <img src="{{$good['list_pic']}}" alt="" width="50">
                                            <input type="hidden" name="list_pic" value="{{$good['list_pic']}}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">商品图册</label>
                                <div class="col-md-9">
                                    <div class="layui-upload">
                                        <button type="button" class="layui-btn" id="test2">多图片上传</button>
                                        <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                                            <div class="layui-upload-list" id="demo2">
                                                @if(old ('pics'))
                                                    @foreach(old ('pics') as $v)
                                                        <li>
                                                            <img src="{{$v}}" width="50" height="50" alt="">
                                                            <input type="hidden" name="list_pic"
                                                                   value="{{$v}}">
                                                        </li>
                                                    @endforeach
                                                @else
                                                    @foreach($good['pics'] as $v)
                                                        <li>
                                                            <img src="{{$v}}" width="50" height="50" alt="">
                                                            <input type="hidden" value="{{$v}}" name="pics[]">
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">商品描述</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="description">{{$good['description']}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">商品详情</label>
                                <div class="col-md-9">
                                    <textarea id="demo" name="content" style="display: none;">
                                         {{$good['content']}}
                                    </textarea>

                                </div>
                            </div>
                        </div>

                        <div class="col-6" id="app">
                            {{--@{{specs}}--}}
                            <div class="card" v-for="(v,k) in specs">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">规格名称</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="v.spec" placeholder="14寸 64G 内存"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">库存</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="v.total" placeholder="100" class="form-control">
                                        </div>
                                    </div>
                                    <button class="btn btn-danger btn-sm pull-right" @click="del(k)" type="button">删除
                                    </button>
                                </div>
                            </div>
                            <div class="">
                                <button type="button" @click="add" class="btn btn-success">添加规格</button>
                            </div>
                            <textarea name="specs" hidden  name="specs"  id="" cols="30" rows="10">@{{ specs }}</textarea>
                        </div>
                    </div>
                    <hr>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-success">保存数据</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('org/layui/css/layui.css')}}">
@endpush
@push('js')
    <script src="{{asset('org/layui/layui.js')}}"></script>
    <script>
        layui.use(['upload', 'layedit'], function () {
            var $ = layui.jquery
                , upload = layui.upload;
            var layedit = layui.layedit;
            //layui编辑器
            layedit.build('demo', {
                //tool: ['left', 'center', 'right', '|', 'face'],//自定义 tollbar
                height: 180 //设置编辑器高度
                , uploadImage: {
                    url: "{{route('util.upload')}}",
                    type: 'post'
                }

            }); //建立编辑器
            //拖拽上传
            upload.render({
                elem: '#test10'
                , url: "{{route('util.upload')}}"
                , data: {}
                , headers: {}//接口的请求头。如：headers: {token: 'sasasas'}。注：该参数为 layui 2.2.6 开始新增
                , accept: 'images' //指定允许上传时校验的文件类型，可选值有：images（图片）、file（所有文件）、video（视频）、audio（音频）
                , acceptMime:"{{hd_config ('upload.upload_accept_mime','image/jpg, image/png,image/jpeg')}}"
                , size: "{{hd_config ('upload.upload_size',20000000)}}"//最大允许上传的文件大小，单位 KB。不支持ie8/9
                , exts: "{{hd_config ('upload.upload_type','jpg|png|gif|bmp|jpeg')}}"
                // ,drag:true //是否接受拖拽的文件上传，默认为ture设置 false 可禁用。不支持ie8/9
                //上传成功之后的回调
                , done: function (res) {
                    //console.log(res)
                    if (res.code == 0) {
                        $('#test10').html('<img src="' + res.data.src + '" alt="" width="50"><input type="hidden" name="list_pic" value="' + res.data.src + '">')
                    } else {
                        // layer.msg(res.msg, {icon: 2}, function () {
                        //     //关闭后的操作
                        // });
                        swal({
                            text: res.msg,
                            icon: "warning",
                            button: false
                        });
                    }
                }
            });
            //多图上传
            upload.render({
                elem: '#test2'
                , url: "{{route('util.upload')}}"
                , multiple: true
                , accept: 'images' //指定允许上传时校验的文件类型，可选值有：images（图片）、file（所有文件）、video（视频）、audio（音频）
                , acceptMime: "{{hd_config ('upload.upload_accept_mime','image/jpg, image/png,image/jpeg')}}"
                , size: "{{hd_config ('upload.upload_size',20000000)}}"  //最大允许上传的文件大小，单位 KB。不支持ie8/9
                , exts: "{{hd_config ('upload.upload_type','jpg|png|gif|bmp|jpeg')}}"
                // ,before: function(obj){
                //     //预读本地文件示例，不支持ie8
                //     obj.preview(function(index, file, result){
                //         $('#demo2').append('<img src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img">')
                //     });
                // }
                , done: function (res) {
                    //上传完毕
                    if (res.code == 0) {
                        $('#demo2').append('<img src="' + res.data.src + '" alt="" width="50" class="layui-upload-img"><input type="hidden" name="pics[]" value="' + res.data.src + '">')
                    } else {
                        swal({
                            text: res.msg,
                            icon: "warning",
                            button: false
                        });
                    }
                }
            });
        });
    </script>
    {{--<script src="https://cdn.bootcss.com/vue/2.5.18-beta.0/vue.min.js"></script>--}}
    <script src="https://cdn.bootcss.com/vue/2.5.18-beta.0/vue.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                specs: {!!  old ('specs')?:json_encode ($good->spec,true) !!}
            },
            methods: {
                add () {
                    this.specs.push({spec: '', total: ''})
                },
                del (k) {
                    this.specs.splice(k, 1)
                }
            }
        })
    </script>
@endpush
