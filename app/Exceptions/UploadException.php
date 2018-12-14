<?php

namespace App\Exceptions;

use Exception;

class UploadException extends Exception
{
    //render()固定写法
    public function render(){
        //return response()->json(['message' =>'上传文件过大', 'code' => 403],200);
        //return response()->json(hdjs要求返回,http状态码);
        //return response()->json([我们自行定义],200);
        //return response()->json(['message'=>$this->getMessage(),'code'=>403],200);
        return response()->json(['msg'=>$this->getMessage(),'code'=>1],200);

    }

}
