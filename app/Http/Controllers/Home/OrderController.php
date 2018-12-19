<?php

namespace App\Http\Controllers\Home;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class OrderController extends CommonController
{
    public function __construct()
    {
        $this->middleware( 'auth' , [
            'except'=>[] ,
        ] );
        //因为如要执行父级构造方法,运行父级构造方法,不然当前构造方法会覆盖父级构造方法
        parent::__construct();
    }
    public function index(Request $request)
    {
        //获得当前用户选中的商品数据
        $carts=$request->query('ids');
        //dd($carts); 字符串
        //explode(',',$carts)将字符串以,的方式分割成数组
        $orders=Cart::whereIn('id',explode(',',$carts))->get();
        //dd($orders);
        //计算总价
        $totalprice=0;
        foreach ($orders as $order){
            //dd($order);
            $totalprice+=$order['num']*$order['price'];
            //dd($totalprice);
        }
        //获取当前用户所有的收货地址
        $addresses=Address::where('user_id',auth()->id())->get();
        //dd($addresses);
        //获得当前用户的默认地址
        $defaultAddresses = Address::where('user_id',auth()->id())->where('is_default',1)->first();
        return view('home.order.index',compact('orders','totalprice','addresses','defaultAddresses'));
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
    public function store(Request $request,Order $order)
    {
        //dd($request->all());
        $ids = $request->ids;
        //根据购物车 ids 获取所有数据
        $cartData = Cart::whereIn('id',explode(',',$ids))->get();
        //dd($cartData);
        $total_price = 0;$total_num = 0;
        foreach($cartData as $v){
            $total_price += $v['num'] * $v['price'];
        }
        DB::beginTransaction();
        //添加订单表
        $order->number = time().str_random(6);
        $order->total_price = $total_price;
        $order->total_num = count($cartData);
        $order->user_id = auth()->id();
        $order->address_id = $request->address_id;
        $order->status = 1;
        $order->save();
        //添加订单详情表
        foreach($cartData as $v){
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->title = $v['title'];
            $orderDetail->price = $v['price'];
            $orderDetail->pic = $v['pic'];
            $orderDetail->num = $v['num'];
            $orderDetail->spec = $v['spec'];
            $orderDetail->good_id = $v['good_id'];
            $orderDetail->spec_id = $v['spec_id'];
            $orderDetail->save();
        }
        //清除购物车对应数据
        Cart::whereIn('id',explode(',',$ids))->where('user_id',auth()->id())->delete();
        DB::commit();
        return ['code'=>1,'msg'=>'提交成功','number'=>$order->number];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
