<?php

namespace App\Http\Controllers\Util;

use App\Exceptions\UploadException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        //必须打印所有 request 请求的数据,需要知道上传文件 name
        //dd($request->all());
        //$request->file('上传文件表单 name')
        $file = $request->file('file');
        $this->checkSize($file);
        $this->checkType($file);
        if ($file) {
            //$path = $file->store('上传文件存储目录','磁盘:filesystems 文件里面看disks');
            //上传需要 php 扩展:fileinfo
            $path = $file->store('upload', 'upload');
            //dd($path);
            return [
                "code" => 0,
                "msg" => '',
                "data" => [
                    "src" => '/'.$path,
                ],
            ];
        }

    }
    //验证上传大小
    private function checkSize($file)
    {
        //$file->getSize()获取上传文件大小
        if ($file->getSize() > hd_config('upload.upload_size')) {
            //return  ['message' =>'上传文件过大', 'code' => 403];
            //使用异常类处理上传异常
            //创建异常类:exception
            throw new UploadException('上传文件过大');
        }
    }
    //验证上传类型
    private function checkType($file)
    {
        if(!in_array(strtolower($file->getClientOriginalExtension()),explode('|',hd_config('upload.upload_type')))){
            //return  ['message' =>'类型不允许', 'code' => 403];
            throw new UploadException('类型不允许');
        }
    }

}
