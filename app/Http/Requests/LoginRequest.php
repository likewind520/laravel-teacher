<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //开启权限
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    //自定义规则
    public function rules()
    {
        return [
            'username'=>'required',
            'password'=>'required'
        ];
    }
    //自定义提示消息
    public function messages()
    {
        return [
            'username.required' => '请输入用户名',
            'password.required'=>'请输入密码'
        ];
    }
}
