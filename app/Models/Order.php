<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderDetail(){
        return $this->hasMany(OrderDetail::class);

    }
    //关联用户 多对一
    public function user(){
        return $this->belongsTo(User::class);

    }
}
