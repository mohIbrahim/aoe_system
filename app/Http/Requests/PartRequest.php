<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartRequest extends FormRequest
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
        $results =  [
            'code'=>'required',
            'name'=>'required',
            'type'=>'required',
            'is_serialized'=>'required',
            'is_serialized'=>'required',
        ];
        if ($this->input('is_serialized') == '0') {
            $results['no_serial_qty'] =  'required|numeric';
        }
        return $results;
    }

    public function messages()
    {
        return  [
                'code.required'=>' برجاء إدخال كود القطعة. ',
                'name.required'=>' برجاء إدخال اسم القطعة. ',
                'type.required'=>' برجاء أختيار نوع القطعة. ',
                'is_serialized.required'=>' برجاء إختيار هل لها قطع فرعية ام لا. ',
                'no_serial_qty.required'=>' برجاء إدخال عدد القطع. ',
                'no_serial_qty.numeric'=>' برجاء إدخال عدد القطع أرقام فقظ. ',
        ];
    }
}
