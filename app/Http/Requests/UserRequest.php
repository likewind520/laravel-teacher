<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    //规则
    public function rules()
    {
        return [
            'name'=>'required',
            //既要验证手机也要验证邮箱
            'account'    => [
                'required',
                function ( $attribute , $value , $fail )
                {
                    if(filter_var($value,FILTER_VALIDATE_EMAIL)){
                        $user = User::where('email',$value)->first();
                    }else{
                        $user = User::where('mobile',$value)->first();
                    }
                    if($user){
                        return $fail( '该账号已存在' );
                    }
                } ,
            ] ,
            'password'=>'required|min:3|confirmed',
            'code'=>[
                'required',
                function ($attribute,$value,$fail){
                    if ($value !=session('code')){
                        $fail('验证码不正确');
                    }
                }

            ],
        ];
    }
    //自定义错误消息提示内容
    public function messages()
    {
        return [
            'name.required'     =>'请输入昵称' ,
            'account.required'  => '请输入注册邮箱' ,
            'password.required' =>'请输入密码' ,
            'password.min'      =>'密码不得少于3位' ,
            'password.confirmed'=>'两次输入密码不一致' ,
            'code.required'     =>'请输入验证码'
        ];
    }
}
