<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $guarded = [];
    //以json的格式存进去,以数组的方式取出来
    protected $casts = [
        'permissions'=>'array'
    ];
}
