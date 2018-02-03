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
            'contract_of_guarantee_id'=>'required|unique:installation_records,contract_of_guarantee_id,'.$this->installation_record,
            'trainee_name'=>'required',
            'installation_date'=>'required|date',
            'installation_record_as_pdf'=>'mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'installation_date.required'=>'برجاء إدخال تاريخ التركيب.',
            'installation_date.date'=>'برجاء إدخال تاريخ التركيب بشكل صحيح.',
            'contract_of_guarantee_id.required'=>' برجاء اختيار عقد الضمان. ',
            'contract_of_guarantee_id.unique'=>' عقد الضمان تم اختياره من قبل برجاء اختيار عقد آخر. ',
            'trainee_name.required'=>'برجاء إدخال اسم المتدرب.',
            'installation_record_as_pdf.mimes'=>' برجاء اختيار صورة لمحضر التركيب بأمتداد PDF.',
        ];
    }
}
