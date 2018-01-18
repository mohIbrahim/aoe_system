<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitRequest extends FormRequest
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
            'visit_date'=>'required|date',
            'readings_of_printing_machine'=>'numeric|nullable',
        ];
    }

    /**
     * [messages description]
     * @return [type] [description]
     */
    public function messages()
    {
        return [
            'visit_date.required'=>' برجاء إدخال تاريخ الزيارة. ',
            'visit_date.date'=>' برجاء إدخال تاريخ الزيارة بشكل صحيح. ',
            'readings_of_printing_machine.numeric'=>' برجاء إدخال قراءة العداد أرقام فقظ '
        ];
    }

}
