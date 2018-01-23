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
            'part_id'=>'required',
            'serial_number'=>'required|unique:part_serial_numbers,serial_number,'.$this->part_serial_number,
            'code'=>'unique:part_serial_numbers,code,'.$this->part_serial_number,
            'date_of_entry'=>'date',
            'date_of_departure'=>'date',
        ];
    }

    public function messages()
    {
        return  [
                    'part_id.required'=>' برجاء اختيار القطعة الرئيسية لهذة القطعة الفرعية. ',
                    'serial_number.required'=>' برجاء إدخال الرقم المسلسل للقطعة. ',
                    'serial_number.unique'=>' الرقم المسلسل تم إدخالة من قبل برجاء تأكد من الرقم وقم بإدخالة بشكل صحيح. ',
                    'code.unique'=>' الكود تم إدخالة من قبل برجاء تأكد وقم بإدخالة بشكل صحيح. ',
                    'date_of_entry.date'=>'برجاء إدخال تاريخ الدخول بشكل صحيح.',
                    'date_of_departure.date'=>'برجاء إدخال تاريخ الخروج بشكل صحيح.',
                ];
    }
}
