<?php

namespace App\Models;

use Houdunwang\Arr\Arr;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //获得树状结构
    //Arr::tree($data, $title, $fieldPri = 'cid', $fieldPid = 'pid');
    //(实例化对象)->tree( 数组 , '字段名称' , '主键id' , '父级id' );
    //$data指的是外面传进来的Category::all()->toArray()
    //$id值得是外面传进来的$category['id']
    public function getTreeData ( $data ) {
        return (new Arr())->tree( $data , 'name' , 'id' , 'pid' );
    }
    //获取编辑时候的所有栏目数据,不包含自己和自己的子集

    public function getEditCategorys($id){
        //首先获取所有栏目数据
        $categories =static::all();
        //        $categories = self::all();
        //        $categories = Category::all();
        //获取当前$id 子集数据
        //dd($categories->toArray());
        $ids = $this->getSon( $categories , $id );
        //dd($ids);
        //把子集追加进去
        $ids[] = $id;
        //dd($ids);
        //将$ids 数据筛出去
        //编辑的那个及子数据,在所属栏目中不显示
        $data = $this->whereNotIn( 'id' , $ids )->get();
        //dd($data->toArray());
        //转为树状结构
        return $this->getTreeData( $data->toArray() );


    }
    //递归当前主键id下的所有子数据
    public function getSon($data,$id){
        //dd($data->toArray()); //Categories库中的所有数据
        //$data是Categories的大集合,在php中也能循环
        //$temp 中存的是所有的子孙数据,不设置静态,后面会覆盖掉前面的数据
        static $temp = [];
        foreach ( $data as $v ) {
            if ( $id == $v['pid'] ) {
                $temp[] = $v['id'];
                $this->getSon( $data , $v['id'] );
            }
        }
        return $temp;
    }
    //关联商品 一对多正向
    public function good ()
    {
        return $this->hasMany( Good::class );
    }

}
