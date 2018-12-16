<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('guest',[
//            'only'=>['login','loginForm','register','store','password_reset','password_resetForm']
//        ]);
//    }
//    登录页面
    public function login(){
        return view('user.login');
    }
//    登录提交
public function loginFrom(Request $request){
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
    if (\Auth::attempt($validate,$remember)) {
        //如果登录页面地址栏接收到from参数，成功后跳回评论区
        if ($request->from){
            return redirect($request->from)->with('success', '登录成功');
        }else{
            //如果没有就跳到首页
            return redirect()->route('home.home')->with('success', '登录成功');
        }
    }
    //登录失败返回
    return redirect()->back()->with('danger', '登录失败');
}
    //重置密码
    public function password_reset()
    {
        return view('user.password_reset');

    }

    //重置密码提交
    public function password_resetForm(PasswordResetRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            //更新密码
            $user->password = bcrypt($request->password);
            $user->save();
            //重向定义跳转
            return redirect()->route('login')->with('success', '重置成功');
        }
        return redirect()->back()->with('danger', '邮箱已注册');
    }

public function logout(){


}
//加载注册页面
public function register(){

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //注册数据提交
    public function store(UserRequest $request)
    {
        $data=$request->all();
        //dd($data);
        $data['password'] = bcrypt($data['password']);
        User::create($data);

        //提示并跳转
        return redirect()->route('login')->with('success', '注册成功');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
