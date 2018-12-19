<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //除了'_token'都能进数据库
    protected $guarded = ['_token'];
}
