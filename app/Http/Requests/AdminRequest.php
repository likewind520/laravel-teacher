<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        $admin=$this->route( 'admin' );

        return [
            'username'=>'required|unique:admins,username,' . $admin[ 'id' ] ,
            'password'=>'required|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'username.required' =>'请输入管理员用户名' ,
            'username.unique'   =>'该管理员已存在' ,
            'password.required' =>'请设置管理员密码' ,
            'password.confirmed'=>'两次密码输入不一致' ,
        ];
    }
}
