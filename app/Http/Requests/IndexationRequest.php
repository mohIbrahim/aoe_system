<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexationRequest extends FormRequest
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
            'code'=>'required|unique:indexations,code,'.$this->indexation,
            'the_date'=>'required|date',
            'reference_id'=>'required|unique:indexations,reference_id,'.$this->indexation,
        ];
    }


    public function messages()
    {
        return [
            'code.required'=>' برجاء إدخال كود المقايسة. ',
            'code.unique'=>' كود المقايسة تم إدخاله من قبل برجاء إدخال كود آخر. ',
            'the_date.required'=>' برجاء اختيار تاريخ المقايسة. ',
            'the_date.date'=>' برجاء إدخال التاريخ بشكل صحيح. ',
            'reference_id.required'=>' برجاء اختيار كود الإشارة. ',
            'reference_id.unique'=>'  كود الإشارة تم اختياره من قبل برجاء اختيار كود آخر. ',
        ];
    }
}
