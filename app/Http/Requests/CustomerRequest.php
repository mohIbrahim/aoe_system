<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'code'=>'required',
            'name'=>'required',
            'type'=>'required'
        ];
    }

    public function messages()
    {
        return [
                    'code.required'=>' برجاء إدخال كود العميل. ',
                    'name.required'=>' برجاء إدخال اسم العميل. ',
                    'type.required'=>' برجاء أختيار نوع العميل. ',
                ];
    }
}
