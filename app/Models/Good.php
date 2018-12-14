<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable = ['title' , 'price' , 'description' , 'content' , 'list_pic' , 'pics' , 'category_id','user_id','total'];
    protected $casts    = [
        'pics' => 'array'
    ];
        //多个商品对一个栏目
    public function category(){

       return $this->belongsTo(Category::class);
    }
    //一个商品有多个规格
    public function spec(){
        return $this->hasMany(Spec::class);
    }
}
