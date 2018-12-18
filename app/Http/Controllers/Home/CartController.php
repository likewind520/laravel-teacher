<?php

namespace App\Http\Controllers\Home;

use App\Models\Cart;
use App\Models\Good;
use App\Models\Spec;
use Doctrine\DBAL\Schema\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends CommonController
{
    public function __construct(){
        $this->middleware('auth',[
            'except'=>[],
        ]);
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(1);
        //获得当前用户所有的商品
        $carts=Cart::where('user_id',auth()->id())->get();
        //这个循环是什么意思?
        foreach($carts as $k=>$cart){
            //给下标一个名为checked值为false的属性标识,
            $carts[$k]['checked'] = false;
        }
        //dd($carts->toArray());
        return view('home.cart.index',compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Cart $cart)
    {
        //dd($request->all());
        //根据商品id获得商品数据
        $good=Good::find($request->id);
        //dd($good->toArray());
        //根据规格id获得规格数据
        $spec=Spec::find($request->spec);
        //dd($spec->toArray());
        //不同的用户买同一个商品,同一个规格 买多个,不希望每加一条都会在数据库中添加一条
        //希望只是num在增加.
        $newCart = Cart::where('user_id',auth()->id())->where('good_id',$request->id)->where('spec_id',$request->spec)->first();
        //dd($newCart);
        if (!$newCart){
            //执行购物车添加
            $cart->pic    =$good->list_pic;
            $cart->good_id=$request->id;
            $cart->title  =$good->title;
            $cart->spec   =$spec->spec;
            $cart->price  =$good->price;
            $cart->num    =$request->num;
            $cart->user_id=auth()->id();
            $cart->spec_id=$request->spec;
            $cart->save();
        }else{
            $newCart->num = (int)$newCart['num'] + (int)$request->num;
            $newCart->save();
        }
        return ['code'=>1,'message'=>'添加成功'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //dd($request->all());
        //dd($cart);
        $cart->num=$request->num;
        $cart->save();
        //$cart->update(['num'=>$request->num]);
        return [ 'code'=>1 , 'msg'=>'更新成功' ];
    }

    //删除
    public function destroy(Request $request,Cart $cart)
    {

        $cart->delete();
        return [ 'code'=>1 , 'msg'=>'删除成功' ];
    }
}
