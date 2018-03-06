<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstallationRecordRequest extends FormRequest
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
            'printing_machine_id'=>'required|unique:installation_records,printing_machine_id,'.$this->installation_record,
            'trainee_name'=>'required',
            'recipient_of_the_printing_machine'=>'required',
            'installation_date'=>'required|date',
            'installation_record_as_pdf'=>'mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'installation_date.required'=>'برجاء إدخال تاريخ التركيب.',
            'installation_date.date'=>'برجاء إدخال تاريخ التركيب بشكل صحيح.',
            'printing_machine_id.required'=>' برجاء اختيار الآلة التصوير. ',
            'printing_machine_id.unique'=>' الآلة التصوير تم اختياره من قبل برجاء اختيار الآلة آخرى. ',
            'trainee_name.required'=>'برجاء إدخال اسم المتدرب.',
            'recipient_of_the_printing_machine.required'=>'برجاء ادخال اسم مستلم الآلة.',
            'installation_record_as_pdf.mimes'=>' برجاء اختيار صورة لمحضر التركيب بأمتداد PDF.',
        ];
    }
}
