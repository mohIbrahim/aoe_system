<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FollowUpCardRequest extends FormRequest
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
            'code'=>'required|unique:follow_up_cards,code,'.$this->follow_up_card,
            'printing_machine_id'=>'required',
            'contract_id'=>'required|unique:follow_up_cards,contract_id,'.$this->follow_up_card,
            'follow_up_card_as_pdf'=>'mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'code.required'=>' برجاء إدخال كود البطاقة. ',
            'code.unique'=>' برجاء إختار كود آخر للبطاقة هذا الكود تم إدخاله من قبل. ',
            'printing_machine_id.required'=>' برجاء اختيار الآلة الخاصة بهذة البطاقة. ',
            'contract_id.required'=>' برجاء اختيار العقد. ',
            'contract_id.unique'=>' هذا العقد تم اختياره من قبل برجاء اختيار عقد آخر. ',
            'follow_up_card_as_pdf.mimes'=>' برجاء اختيار صورة بطاقة المتابعة بأمتداد PDF.',
        ];
    }
}
