<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'job_title'=>'required',
            'date_of_hiring'=>'date|nullable',
            'salary'=>'numeric|nullable',
        ];
    }

    public function messages()
    {
        return [
            'job_title.required'=>' برجاء إختيار المسمى الوظيفي. ',
            'date_of_hiring.date'=>' برجاء إدخال تاريخ التعيين بشكل صحيح. ',
            'salary.numeric'=>' برجاء إدخال الراتب بشكل صحيح. ',
        ];
    }
}
