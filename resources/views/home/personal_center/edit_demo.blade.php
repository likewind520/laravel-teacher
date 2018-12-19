@extends('home.layouts.master')
@section('content')
    <div data-toggle="distpicker">
        <select data-province="山西省"></select>
        <select data-city="---- 选择市 ----"></select>
        <select data-district="---- 选择区 ----"></select>
    </div>
    <hr>
    <div id="distpicker1">
        <select></select>
        <select></select>
        <select></select>
    </div>

@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset ('org/home')}}/css/account.css"/>
@endpush
@push('js')
    {{--三级城市联动--}}
    <script src="https://cdn.bootcss.com/distpicker/2.0.5/distpicker.min.js"></script>
    <script src="{{asset ('org/home')}}/js/list.js" type="text/javascript" charset="utf-8"></script>
    <script>
        $("#distpicker1").distpicker({
            province: '山西省',
            city: '---- 所在市 ----',
            district: '---- 所在区 ----'
        });
    </script>
@endpush
