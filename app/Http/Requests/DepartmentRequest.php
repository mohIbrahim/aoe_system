<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'name'=>'required|unique:departments,name,'.$this->department,
        ];
    }

    public function messages()
    {
        return  [
                    'name.required'=>' برجاء إدخال اسم القسم. ',
                    'name.unique'=>' اسم القسم تم استخدامة من قبل، برجاء أختار اسم آخر. ',
                ];
    }
}
