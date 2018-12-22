<?php

namespace App\Http\Controllers\Home;

use App\Models\Category;
use App\Models\Keyword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function __construct()
    {
        //数据共享,每个页面都能用到这个数据
        //参考laravel中国(view) https://laravel-china.org/docs/laravel/5.7/views/2259#9f239f
        //获取所有顶级栏目数据
        $_categories = Category::where('pid',0)->limit(5)->get();
        //\View::share('_categories',$_categories);相当于compact('_categories')
        \View::share('_categories',$_categories);
        //获取搜索关键词
        $keywords = Keyword::orderBy('click','desc')->limit(5)->get();
        \View::share('_keywords',$keywords);
    }
}
