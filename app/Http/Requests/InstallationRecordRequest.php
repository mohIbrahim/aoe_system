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
            'trainee_name'=>'required',
            'installation_date'=>'required|date',
        ];
    }

    public function messages()
    {
        return [
            'trainee_name.required'=>'برجاء إدخال اسم المتدرب.',
            'installation_date.required'=>'برجاء إدخال تاريخ التركيب.',
            'installation_date.date'=>'برجاء إدخال تاريخ التركيب بشكل صحيح.',
        ];
    }
}
