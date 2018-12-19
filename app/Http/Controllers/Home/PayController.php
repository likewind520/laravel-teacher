<?php

namespace App\Http\Controllers\Home;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PayController extends CommonController
{
        public function index(Request $request){
            //根据订单号获取订单数据
            $order = Order::where('number',$request->query('number'))->first();
            //dump($order->toArray());
            return view('home.pay.index',compact('order'));
        }
}
