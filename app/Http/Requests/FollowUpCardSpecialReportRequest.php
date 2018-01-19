<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FollowUpCardSpecialReportRequest extends FormRequest
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
            'the_date'=>'required|date',
            'report'=>'required',
            'readings_of_printing_machine'=>'numeric|nullable',
        ];
    }

    public function messages()
    {
        return [
            'the_date.required'=>' برجاء إدخال التاريخ. ',
            'the_date.date'=>'   برجاء إدخال التاريخ بشكل الصحيح. ',
            'report.required'=>' برجاء إدخال التقرير. ',
            'readings_of_printing_machine.numeric'=>' برجاء إدخال قراءة العداد أرقام فقط. ',
        ];
    }
}
