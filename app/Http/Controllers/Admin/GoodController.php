<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GoodRequest;
use App\Models\Category;
use App\Models\Good;
use App\Models\Spec;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //dd($request->toArray());
        //添加商品列表
        $data=$request->all();
        //dd($data);
        $data['user_id']=auth('admin')->id();
        //dd($data['specs']);
        $specs = json_decode ( $data['specs'] , true );
        //dd($specs);
        //计算商品总数量
        $total = 0;
        foreach ( $specs as $v )
        {
            $total += $v['total'];
        }
        $data['total'] = $total;
        //执行完成 create 之后,返回当前添加数据对象
        $good = $good->create ( $data );
        //dd($good);
        //添加商品详情表
        foreach ( $specs as $v )
        {
            $spec        = new Spec();
            $spec->spec  = $v['spec'];
            $spec->total = $v['total'];
            $spec->good_id =$good->id;
            $spec->save ();
        }
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

        $categories=$category->getEditCategorys($good['id']);
        //dd($categories);
        //$specs=json_encode(Spec::where('good_id',$good->id)->get());
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
       //dd(1);
        $data=$request->all();
        //dd($data);
        //dd($data['specs']);
        $specs = json_decode ( $data['specs'] , true );
        //dd($specs);
        //计算商品总数量
        $total = 0;
        foreach ( $specs as $v )
        {
            $total += $v['total'];
        }
        $data['total'] = $total;
        //执行完成 create 之后,返回当前添加数据对象
        $good->update($data);
        //dd($good);
        //更新商品详情表
        foreach ( $specs as $v )
        {
            $spec        = new Spec();
            $spec->spec  = $v['spec'];
            $spec->total = $v['total'];
            $spec->good_id =$good['id'];
            $spec->save ();
        }
        return redirect()->route('admin.good.index')->with('success','添加成功');
    }

    //删除
    public function destroy(Good $good)
    {
        $good->delete();
        return redirect()->route( 'admin.good.index' )->with( 'success' , '操作成功' );
    }
}
