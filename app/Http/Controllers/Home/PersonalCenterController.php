<?php

namespace App\Http\Controllers\Home;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonalCenterController extends CommonController
{
    public function __construct()
    {
        $this->middleware( 'auth' , [
            'except'=>[] ,
        ] );
        //因为如要执行父级构造方法,运行父级构造方法,不然当前构造方法会覆盖父级构造方法
        parent::__construct();
    }

    public function index(){
        return view('home.personal_center.index');
    }
    //个人信息
    public function editMessage(User $user){
        return view( 'home.personal_center.edit_messages' , compact( 'user' ) );
    }

}
