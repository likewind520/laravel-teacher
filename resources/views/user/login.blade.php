<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="icon" type="text/css" href="icon.ico"/>
    <link rel="stylesheet" type="text/css" href="{{asset ('org/home')}}/css/index.css" />
    <script src="{{asset ('org/home')}}/js/jquery-1.10.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset ('org/home')}}/js/list.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>
<div class="regcontent">
    <div class="layout">

        <form action="{{route('login')}}" method="post">
            @csrf
            <div class="reglogo">
                <a href=""><img src="{{asset ('org/home')}}/images/360logo.png" /></a>
                <span>帐号登录</span>
            </div>
            <div class="reginput">
                <div><input  type="email" value="{{old('email')}}" name="email" id="email" placeholder="请输入邮箱" /></div>
                <div><input  type="password" name="password" placeholder="请输入密码"  /></div>
                <div class="form-check">
                    <input style="width:16px"  type="checkbox" class="form-check-input" name="remember" id="remember" value="1">
                    <label class="form-check-label" for="remember">记住我</label>
                </div>
            </div>
            <div class="btn"><input type="submit" id="" name="" value="登录" /></div>

        </form>

        <div class="waring">
            <span>没有账号?<a href="{{route('register')}}">去注册吧</a> <a href="{{route('passwordReset')}}">重置密码</a></span>
            <span><a href="">忘记密码</a></span>
        </div>
    </div>
</div>
@include('layouts.message')
</body>

</html>
