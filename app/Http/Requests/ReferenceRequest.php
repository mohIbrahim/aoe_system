<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReferenceRequest extends FormRequest
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
            'type'=>'required',
            'received_date'=>'required|date',
        ];
    }

    public function messages()
    {
        return [
            'code.required'=>' برجاء إدخال كود الإشارة. ',
            'type.required'=>' برجاء إدخال نوع الإشارة. ',
            'received_date.required'=>' برجاء إدخال تاريخ الإشارة. ',
            'received_date.date'=>' برجاء إدخال تاريخ الإشارة بشكل صحيح. ',
        ];
    }
}
