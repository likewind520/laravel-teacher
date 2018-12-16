<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="icon" type="text/css" href="icon.ico"/>
    <link rel="stylesheet" type="text/css" href="{{asset ('org/home')}}/css/index.css" />
    <script src="{{asset ('org/home')}}/js/jquery-1.10.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset ('org/home')}}/js/list.js" type="text/javascript" charset="utf-8"></script>
    <meta name="csrf-token" content="{{csrf_token()}}">
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

<body style="background: #f5f5f5;">
<div class="regcontent">
    <div class="layout">

        <form action="{{route('passwordReset')}}" method="post">
            @csrf
            <div class="reglogo">
                <a href=""><img src="{{asset ('org/home')}}/images/360logo.png" /></a>
                <span>重置密码</span>
            </div>
            <div class="reginput">
                <div><input type="email" value="{{old('email')}}" name="email" id="email" placeholder="请输入邮箱" /></div>
                <div><input type="password" name="password" placeholder="请输入密码"/></div>
                <div><input type="password" name="password_confirmation" class="form-control" placeholder="请确认密码"></div>
                <div class="code"><input type="text" name="code" id="" value="" class="codeimg" placeholder="请输入验证码"  /><img onclick="sendCode()" src="{{asset ('org/home')}}/images/car.jpg" /></div>
            </div>
            <div class="btn"><input type="submit" name="" value="重置密码" /></div>
        </form>
        {{--<div class="other">--}}
            {{--<div class="regline"></div>--}}
            {{--<div class="regzi">其他方式登录</div>--}}
        {{--</div>--}}
        {{--<div class="regqq">--}}
            {{--<div class="regbian">--}}
                {{--<a href=""></a>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="waring">
            <span>已有账号?<a href="{{route('login')}}">去登录吧</a> <a href="{{route('home.home')}}">返回首页</a></span>
        </div>
    </div>
</div>
@include('layouts.message')
<script src="{{asset ('org/layer/layer.js')}}"></script>
<script>
    // 抓取id为email元素
    function sendCode(){
        //抓取表单中的元素.val() 不能用.html()
        let id=$('#email').val();
        // console.log($('#email').val());

        // layer.load();

        $.post("{{route ('util.code.send')}}",{id:id},function (res) {
            // layer.closeAll('loading');
            console.log(res)
        },'json')
    }
    </script>
</body>
</html>
