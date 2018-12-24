<?php

namespace App\Exceptions;

use Exception;

class PermissionException extends Exception
{
   //用抛出异常的方式代替弹窗
   //render()固定写法
    public function render(){
        return redirect()->back()->with( 'danger' , $this->getMessage () );

    }
}
