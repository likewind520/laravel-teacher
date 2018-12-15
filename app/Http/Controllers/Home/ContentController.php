<?php

namespace App\Http\Controllers\Home;

use App\Models\Good;
use App\Models\Spec;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends CommonController
{
    public function index ( Good $content )
    {
        //dd($content->spec);
        return view ( 'home.content.index' , compact ( 'content' ) );
    }

    public function specGetTotal (Request $request )
    {
        //规格
        //dd($request->all ());
        return Spec::find ( $request->id );
    }
}
