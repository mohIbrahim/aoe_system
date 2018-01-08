<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        return  [
                    'code'=>'required',
                    'name'=>'required',
                    'type'=>'required',
                    'email'=>'email|nullable',
                    'telecom.*'=>'required|numeric',
                ];
    }

    public function messages()
    {
        $validationMessages =   [
                                    'code.required'=>' برجاء إدخال كود العميل. ',
                                    'name.required'=>' برجاء إدخال اسم العميل. ',
                                    'type.required'=>' برجاء أختيار نوع العميل. ',
                                    'email.email'=>' برجاء إدخال الإيمل بشكل صحيح. ',
                                ];
        for($i = 0 ; $i < count($this->telecom) ;$i++){
            $validationMessages["telecom*$i.required"] = "برجاء إدخال رقم الهاتف للحقل رقم ".($i+1);
        }
        return  $validationMessages;
    }
}
