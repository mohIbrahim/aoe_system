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
            'code'=>'required|unique:references,code,'.$this->reference,
            'employee_id_who_receive_the_reference'=>'required',
            'type'=>'required',
            'status'=>'required',
            'received_date'=>'required|date',
            'printing_machine_id'=>'required',
            'reference_as_pdf'=>'mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'code.required'=>' برجاء إدخال كود الإشارة. ',
            'employee_id_who_receive_the_reference.required'=>' برجاء اختيار اسم مستلم الإشارة. ',
            'code.unique'=>' كود الإشارة تم إدخاله من قبل برجاء إدخال كود آخر. ',
            'type.required'=>' برجاء إدخال نوع الإشارة. ',
            'status.required'=>' برجاء إدخال حالة الإشارة. ',
            'received_date.required'=>' برجاء إدخال تاريخ الإشارة. ',
            'received_date.date'=>' برجاء إدخال تاريخ الإشارة بشكل صحيح. ',
            'printing_machine_id.required'=>' برجاء اختيار الآلة التصوير. ',
            'reference_as_pdf.mimes'=>' برجاء اختيار صورة للإشارة بأمتداد PDF.',
        ];
    }
}
