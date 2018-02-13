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
            'reference_id'=>'nullable|unique:indexations,reference_id,'.$this->indexation,
            'visit_id'=>'required|unique:indexations,visit_id,'.$this->indexation,
            'indexation_as_pdf'=>'mimes:pdf',
        ];
    }


    public function messages()
    {
        return [
            'code.required'=>' برجاء إدخال كود المقايسة. ',
            'code.unique'=>' كود المقايسة تم إدخاله من قبل برجاء إدخال كود آخر. ',
            'the_date.required'=>' برجاء اختيار تاريخ المقايسة. ',
            'the_date.date'=>' برجاء إدخال التاريخ بشكل صحيح. ',
            'reference_id.unique'=>'  كود الإشارة تم اختياره من قبل برجاء اختيار كود آخر. ',
            'visit_id.required'=>' برجاء اختيار رقم الزيارة. ',
            'visit_id.unique'=>'  رقم الزيارة تم اختياره من قبل برجاء اختيار رقم آخر. ',
            'indexation_as_pdf.mimes'=> ' برجاء اختيار صورة المقايسة بأمتداد pdf. ',
        ];
    }
}
