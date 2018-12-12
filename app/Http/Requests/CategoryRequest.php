<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return true; 与下面的方式一样,用户登录的权限
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route( 'category' ) ? $this->route( 'category' )->id : null;
        return [
            //unique:table,column,except,idColumn 在这个表中的这一列,除了自己本身外唯一,在编辑中使用.
            'name' => 'required|unique:categories,name,'.$id ,
            'pid' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '请输入栏目名称',
            'name.unique' => '栏目名称已存在',
            'pid.required' => '请选择所属栏目',
        ];
    }

}
