<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //加载栏目首页页面
    public function index(Category $category)
    {
        //dd($category->toArray());
        $categories=$category->getTreeData(Category::all()->toArray());
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //加载添加栏目页面
    public function create(Category $category)
    {

        //获取所有栏目数据,用于循环到添加页面父级栏目
       $categories=$category->getTreeData(Category::all()->toArray());
       //dd($categories);
        return view('admin.category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request,Category $category)
    {
        //dd($request->all());
        $category->name=$request->name;
        $category->pid=$request->pid;
        $category->save();
        return redirect()->route('admin.category.index')->with('success','添加成功');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        $categories=$category->getEditCategorys($category['id']);
        //dd($categories);
        //dd($category->toArray());
       return view('admin.category.edit',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->pid  = $request->pid;
        $category->save();
        return redirect()->route( 'admin.category.index' )->with( 'success' , '栏目编辑成功' );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //where('pid',$category['id'],说明是父级有子级,返回,请先删除子集
        if(Category::where('pid',$category['id'])->first()){
            return redirect()->back()->with( 'danger' , '请先删除子集数据' );
        }
        $category->delete();
        return redirect()->route( 'admin.category.index' )->with( 'success' , '操作成功' );
    }
}
