<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartserialNumberRequest extends FormRequest
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
            'serial_number'=>'required|unique:part_serial_numbers,serial_number,'.$this->part_serial_number,
        ];
    }

    public function messages()
    {
        return  [
                    'serial_number.required'=>' برجاء إدخال الرقم المسلسل للقطعة. ',
                    'serial_number.unique'=>' الرقم المسلسل تم إدخالة من قبل برجاء تأكد من الرقم وقم بإدخالة بشكل صحيح. ',
                ];
    }
}
