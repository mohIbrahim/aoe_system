<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartRequest extends FormRequest
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
            'type'=>'required',
        ];
    }

    public function messages()
    {
        return  [
                'code.required'=>' برجاء إدخال كود القطعة. ',
                'name.required'=>' برجاء إدخال اسم القطعة. ',
                'type.required'=>' برجاء أختيار نوع القطعة. ',
        ];
    }
}
