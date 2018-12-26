<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeLoginRequest extends FormRequest
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
    public function rules ()
    {
        return [
            'account'    => 'required' ,
            'password' => 'required|min:3'
        ];
    }

    public function messages ()
    {
        return [
            'account.required'    => '请输入注册邮箱' ,
            'password.required' => '请输入密码',
            'password.min' => '密码不得小于三位'
        ];
    }
}
