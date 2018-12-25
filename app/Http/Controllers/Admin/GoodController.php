<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GoodRequest;
use App\Models\Category;
use App\Models\Good;
use App\Models\Spec;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        admin_has_permission( 'Admin-good' );
        //获得所有商品列表数据
        $goods=Good::all();
        //获得商品所有规格和库存
        $specs=Spec::all();
        return view('admin.good.index',compact('goods','specs'));
    }

    /**s
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        admin_has_permission( 'Admin-good' );
        //获取所有栏目数据,用于循环到添加页面父级栏目
        $categories=$category->getTreeData(Category::all()->toArray());
        return view('admin.good.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GoodRequest $request,Good $good)
    {
        admin_has_permission( 'Admin-good' );
        DB::beginTransaction();//开启事务
        //添加商品表
        $data                 =$request->all();
        $data[ 'description' ]=$data[ 'description' ] ? : '';
        $data[ 'admin_id' ]   =auth( 'admin' )->id();

        $specs=json_decode( $data[ 'specs' ] , true );
        //        dd($specs);
        //计算商品总数量
        $total=0;
        foreach( $specs as $v ){
            $total+=(int) $v[ 'total' ];
        }
        $data[ 'total' ]=$total;
        //执行完成 create 之后,返回当前添加数据对象
        $good=$good->create( $data );
        //        dd($good);
        //添加商品详情表
        foreach( $specs as $v ){
            $spec         =new Spec();
            $spec->spec   =$v[ 'spec' ];
            $spec->total  =$v[ 'total' ];
            $spec->good_id=$good->id;
            $spec->save();
        }
        DB::commit();//提交事务
        return redirect()->route('admin.good.index')->with('success','添加成功');
    }

    public function show(Good $good)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function edit(Good $good,Category $category,Spec $spec)
    {
        admin_has_permission( 'Admin-good' );
        $categories=$category->getEditCategorys($good['id']);
        //dd($categories);
//        $specs=json_encode(Spec::where('good_id',$good->id)->get());
        //dd($good->spec);
        //dd($goods);
        return view('admin.good.edit',compact('categories','good'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function update(GoodRequest $request, Good $good)
    {

        admin_has_permission( 'Admin-good' );
        DB::beginTransaction();//开启事务
        //添加商品表
        $data                 =$request->all();
        $data[ 'admin_id' ]   =auth( 'admin' )->id();
        $data[ 'description' ]=$data[ 'description' ] ? : '';
        $specs                =json_decode( $data[ 'specs' ] , true );
        //        dd($specs);
        //计算商品总数量
        $total=0;
        foreach( $specs as $v ){
            $total+=(int) $v[ 'total' ];
        }
        $data[ 'total' ]=$total;
        //执行完成 create 之后,返回当前添加数据对象
        $good->update( $data );
        //        dd($good);
        //添加商品详情表
        //首先将原先数据删除再执行添加
        $good->spec()->delete();
        foreach( $specs as $v ){
            $spec         =new Spec();
            $spec->spec   =$v[ 'spec' ];
            $spec->total  =(int) $v[ 'total' ];
            $spec->good_id=$good->id;
            $spec->save();
        }
        DB::commit();//提交事务
        return redirect()->route('admin.good.index')->with('success','添加成功');
    }

    //删除
    public function destroy(Good $good)
    {
        admin_has_permission( 'Admin-good' );
        //dd($good);
        $good->delete();
        return redirect()->route( 'admin.good.index' )->with( 'success' , '操作成功' );
    }
}
