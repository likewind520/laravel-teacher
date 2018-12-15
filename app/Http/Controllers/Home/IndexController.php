<?php

namespace App\Http\Controllers\Home;

use App\Models\Category;
use App\Models\Good;
use Houdunwang\Arr\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends CommonController
{
    public function index(Category $category){
        //dd(1);
        //获得所有栏目的数据
        $categories=Category::all()->toArray();
        //dd($categories);
        //获取所有栏目数据.左侧菜单数据
        $categoryData = (new Arr())->channelLevel($categories, $pid = 0, $html = "&nbsp;", $fieldPri = 'id', $fieldPid = 'pid');
        //dd($categoryData);
        //轮播图右侧随机两个商品
        $good = Good::inRandomOrder()->limit(2)->get();
        //dd($good);
        //获取最近发布的五个商品
        $latestGood = Good::latest()->limit(5)->get();
        //dd($latestGood);
        //第一楼层
        //找家用电子所有子集数据
        $sonIds = $category->getSon ($categories,14);
        $sonIds[] = 14;
        //dd($sonIds);
        $oneFloor = [
            'name'=>'家用电器',
            'data'=>Good::whereIn('category_id',$sonIds)->get()
        ];
        //dd($oneFloor);
        return view('home.index.index',compact('categoryData','good','latestGood','oneFloor'));

    }
}
