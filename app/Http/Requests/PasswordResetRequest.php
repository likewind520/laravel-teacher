<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'   =>'email' ,
            'password'=>'required|min:3|confirmed' ,
            'code'    =>[
                'required' ,
                //使用表单验证--自定义验证规则--使用闭包
                //$value 表单提交过来的code对应的值
                function( $attribute , $value , $fail ){
                    if( $value != session( 'code' ) ){
                        $fail( '验证码不正确' );
                    }
                } ,
            ] ,

        ];
    }
    //自定义错误消息提示内容
    public function messages()
    {
        return [
            'email.email'       =>'请输入正确邮箱' ,
            'password.required' =>'请输入密码' ,
            'password.min'      =>'密码不得少于3位' ,
            'password.confirmed'=>'两次输入密码不一致' ,
            'code.required'     =>'请输入验证码'
        ];
    }
}
