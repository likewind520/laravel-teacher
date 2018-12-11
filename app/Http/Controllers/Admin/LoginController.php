<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //加载登录首页页面
    public function index(){
        return view('admin.login.index');
    }
    //登录提交
    public function login(LoginRequest $request){
       // dd($request->all());
        if (\Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)){
            return redirect()->route('admin.index')->with('success', '登录成功');
        }
        return redirect()->back()->with('danger', '用户名或密码不正确');

    }
    //退出
    public function logout(){
        // dd($request->all());
        \Auth::guard('admin')->logout();
        return redirect()->route('admin.login');

    }
}
