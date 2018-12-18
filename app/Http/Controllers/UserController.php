<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Home\CommonController;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\UserRequest;
use App\Notifications\ResetPasswordNotify;
use App\User;
use Illuminate\Http\Request;

class UserController extends CommonController
{
    public function __construct()
    {
        $this->middleware( 'auth' , [
            'only'=>[ 'edit' , 'update' ]
        ] );
        parent::__construct();
    }

//    登录页面
    public function login()
    {
        return view('user.login');
    }

//    登录提交
    public function loginFrom(Request $request)
    {
        //dd($request->toArray());
        //自定义验证规则
        $this->validate(
            $request,
            [
                //邮箱类型和密码不能为空以及至少需要三位
                'email' => 'email',
                'password' => 'required|min:3',

            ],
            [
                //把默认的英文提示信息改为中文
                'email.email' => '请输入邮箱',
                'password.required' => '请输入登录密码',
                'password.min' => '密码不得小于三位',
            ]
        );
        //执行登录
        $validate = $request->only('email', 'password');
        $remember = $request->remember;
        //dd($remember);
        //\Auth::attempt()框架中自带的自动验证系统
        if (\Auth::attempt($validate, $remember)) {
            //如果登录页面地址栏接收到from参数，
            if ($request->from) {
                return redirect($request->from)->with('success', '登录成功');
            } else {
                //如果没有就跳到首页
                return redirect()->route('home.home')->with('success', '登录成功');
            }
        }

        //登录失败返回
        return redirect()->back()->with('danger', '账户或密码不正确');
    }
    //重置密码 用另外发邮箱连接的方式更改密码,不需要发送验证码
//    public function password_reset()
//    {
//        return view('user.password_reset');
//
//    }

    //重置密码提交
//    public function password_resetForm(PasswordResetRequest $request)
//    {
//        $user = User::where('email', $request->email)->first();
//        if ($user) {
//            更新密码
//            $user->password = bcrypt($request->password);
//            $user->save();
    //重向定义跳转
//            return redirect()->route('login')->with('success', '重置成功');
//        }
//        return redirect()->back()->with('danger', '邮箱已注册');
//    }

    public function logout(Request $request)
    {

        //框架自带的
        \Auth::logout();
        //dd($request->query('from'));
        return redirect($request->query ( 'from' ) ?: '/' );

    }

    //加载注册页面
    public function register()
    {

        return view('user.register');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    //注册数据提交
    public function store(UserRequest $request)
    {
        $data = $request->all();
        //dd($data);
        $data['password'] = bcrypt($data['password']);
        // $data[ 'name' ]    =$data[ 'name' ] ? : '';//给每个用户昵称,因为数据表设置 name 不允许为空所以需要给出默认值
        $data['token'] = str_random(50);//给每个注册用户随机一个字符串
        //修改数据表中 email_verified_at 字段
        $data['email_verified_at'] = now();//now()函数获取当前时间
        $user = User::create($data);
        //写入数据成功之后修改用户默认昵称,默认值设置为:超人 n 号,这个默认值给什么自行定义
        //$user->name='黎明' . $user[ 'id' ] . '号';
        $user->save();

        //提示并跳转
        return redirect()->route('login')->with('success', '注册成功');

    }

    //通过发送连接的方式重置密码,这里就不用验证码了
    //加载发送连接模板页面
    public function forgetPasswordView()
    {
        return view('user.forget_password');
    }

    //重置密码发送连接到注册邮箱
    public function forgetPassword(Request $request)
    {
        //dd($request->toArray());
        //1.进行表单验证
        $this->validate(
            $request,
            [
                'email' => 'required|email',
            ],
            [
                'email.required' => '请输入邮箱',
                'email.email' => '邮箱格式不正确',
            ]
        );
        //根据用户提交来的邮箱去数据库查找数据,防止恶意邮箱验证
        //first() 相当于get()获得一条数据
        $user = User::where('email', $request->email)->first();
        //dd($user);
        //2.如果用户存在,就给他发邮件
        if ($user) {
            //发邮件
            $user->notify(new ResetPasswordNotify($user->token));

            return back()->with('success', '邮件发送成功');
        }

        return back()->with('danger', '该邮箱未注册');
    }

    //收到邮件之后点击链接进行密码重置
    public function resetPasswordView($token)
    {
        //因为在注册的时候提交数据中携带token令牌.没有令牌就说明没有注册,
        //在发送邮箱的时候做了一个验证,必须是数据库注册的邮箱.
        //这里再做一次拦截,即使发送到没注册的邮箱去了,一定是没有携带令牌的,让他跳回首页
        $user = User::where('token', $token)->first();
        if (!$user) {
            return redirect()->route('home.home');
        }

        return view('user.reset_password', compact('token'));
    }

    //密码重置
    public function resetPassword($token, Request $request)
    {
        $this->validate(
            $request,
            ['password' => 'required|confirmed'],
            [
                'password.required' => '请输入新密码',
                'password.confirmed' => '两次输入密码不一致',
            ]
        );
        $user = User::where('token', $token)->first();
        if (!$user) {
            return redirect('/');
        }
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('login')->with('success', '密码修改成功');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
//        return view( 'home.user.edit' , compact( 'user' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User                $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
