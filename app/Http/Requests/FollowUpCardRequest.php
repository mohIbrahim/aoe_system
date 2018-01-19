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
        ];
    }

    public function messages()
    {
        return [
                'code.required'=>' برجاء إدخال كود البطاقة. ',
                'code.unique'=>' برجاء إختار كود آخر للبطاقة هذا الكود تم إدخاله من قبل. ',
        ];
    }
}
