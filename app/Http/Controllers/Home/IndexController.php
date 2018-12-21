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
        //第二楼数据
        Category::$temp=[];
        $sonIds        =$category->getSon( $categories , 15 );
        $sonIds[]      =15;
        //dd($sonIds);
        $twoFloor=[
            'name'=>'手机/运营商/数码' ,
            'data'=>Good::whereIn( 'category_id' , $sonIds )->get()
        ];
        //新品速递
        $newGoods=Good::latest()->limit( 15 )->get();
        return view('home.index.index',compact('categoryData','good','latestGood','oneFloor','newGoods','twoFloor'));

    }
    public function qqBack(){
        echo 1;
    }
}
