<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateCategory extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'category_product_name'=>['required'],
            'category_product_desc'=>['required'],
            'category_product_keywords'=>['required'],
        ];
    }
    public function messages()
    {
        return[
            'category_product_name.required' => 'Cần Phải Có Tên Danh Mục'
        ];
    }
}
