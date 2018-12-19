<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends CommonController
{
    public function __construct()
    {
        $this->middleware( 'auth' , [
            'except'=>[] ,
        ] );
        //因为如要执行父级构造方法,运行父级构造方法,不然当前构造方法会覆盖父级构造方法
        parent::__construct();
    }
    public function index()
    {
        //获取所有地址数据
        $addresses = Address::get();
        //dump($addresses);
        return view('home.address.index',compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //加载添加地址页面
    public function create()
    {
        return view('home.address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        //dd($request->toArray());

        $address=auth()->user()->address()->create($request->all());
        //将其他数据默认地址修改
        if($request->is_default){
            Address::where('user_id',auth()->id())->where('id','!=',$address['id'])->update(['is_default'=>0]);
        }
        return redirect()->route('home.address.index')->with('success','地址添加成功');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
         //dd($address);
        Address::where('user_id',auth()->id())->where('id',$address['id'])->update(['is_default'=>1]);
        Address::where('user_id',auth()->id())->where('id','!=',$address['id'])->update(['is_default'=>0]);
        return back();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    //加载模板页面
    public function edit(Address $address)
    {
        return view('home.address.edit',compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Address $address)
    {
        $address->delete();
        return redirect()->back()->with('success','删除成功');
    }
}
