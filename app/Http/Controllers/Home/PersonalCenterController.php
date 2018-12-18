<?php

namespace App\Http\Controllers\Home;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonalCenterController extends CommonController
{
    public function index(){
        return view('home.personal_center.index');
    }

//    public function edit(User $user){
//        return view( 'home.user.edit' , compact( 'user' ) );
//    }
}
