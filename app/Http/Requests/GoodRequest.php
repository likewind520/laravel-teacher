<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required',
            'price'=>'required|numeric|min:1,999',
            'description'=>'required',
            'category_id'=>'required',
            'list_pic'=>'required',
            'pics'=>'required',
            'content'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'请输入商品名称',
            'price.required'=>'请输入商品价格',
            'price.numeric'=>'请输入数字',
            'price.min'=>'请输入整数',
            'description.required'=>'请输入商品描述',
            'category_id.required'=>'请选所属栏目',
            'list_pic.required'=>'请选择商品列表图',
            'pics.required'=>'请选择商品图册',
            'content.required'=>'请输入商品详情'


        ];
    }
}
