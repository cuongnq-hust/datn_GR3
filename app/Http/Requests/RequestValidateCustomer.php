<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateCustomer extends FormRequest
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
            'customer_name'=>['required'],
            'customer_email'=>['required'],
            'customer_password'=>['required'],
            'customer_phone'=>['required'],
            'shipping_name'=>['required'],
            'shipping_phone'=>['required'],
            'shipping_email'=>['required'],
            'shipping_notes'=>['required'],
            'shipping_address'=>['required'],


        ];
    }
}
