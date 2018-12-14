<?php

namespace App\Http\Controllers\Admin;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    //加载模板页面
    public function edit($name){
        //dd($name);
        $config=Config::firstOrNew(
            ['name'=>$name]
        );
        return view('admin.config.create_'.$name,compact('name','config'));


    }
    //创建 修改配置项
    public function update($name, Request $request){
        //updateOrCreate 执行更新或者添加
        //updateOrCreate手册位置: Eloquent ORM-->快读入门
        $res=Config::updateOrCreate(
            ['name'=>$name],//查询条件
            //注意:$request->all()是数组,直接写入数据表报错
            //需要借助模型属性 cates 将数组转为json存入数据库
            ['name'=>$name,'data'=>$request->all()]//更新或者添加的数据
        );
        //执行这个命令 composer require houdunwang/laravel
        //就可以直接调用hd_edit_env()函数
        //缓存所有数据
        hd_edit_env($request->all());
        return back()->with('success','配置项更新成功');
    }
}
