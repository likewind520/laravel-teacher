<?php

namespace App\Http\Controllers\Home;

use App\Models\Category;
use App\Models\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListController extends CommonController
{
    public function index ( $list , Category $category )
    {
        //获取所有栏目数据
        $categories = Category::all ()->toArray ();
        //获取当前栏目下所有子栏目商品
        $sonIds = $category->getSon ( $categories , $list );
        //将子集追加进去
        $sonIds[] = $list;
        //获取在 sonIds 里面所有商品
        $goods = Good::whereIn('category_id',$sonIds);
        if(\request ()->query('price') == 'asc'){
            $goods = $goods->orderBy('price','asc');
        }
        if(\request ()->query('price') == 'desc'){
            $goods = $goods->orderBy('price','desc');
        }
        $goods = $goods->orderBy('created_at','desc')->paginate(10);
        //获取当前栏目所有儿子栏目
        $sonCategoy = Category::where('pid',$list)->get();
        //dd($sonCategoy);
        //面包屑(递归找父) 用到"首页>家用电器>电视机"
        //$list 是路由参数,模板中的id
        $fatherData = $category->getFacher($categories,$list);
        //数组翻转 array_reverse
        $fatherData = array_reverse ($fatherData);
        //dd($fatherData);
        return view ( 'home.list.index' ,compact ('goods','list','sonCategoy','fatherData'));
    }
}
