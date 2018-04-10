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
                    // 'code'=>'required|unique:customers,code,'.$this->customer,
                    'sector'=>'required',
                    'name'=>'required',
                    'type'=>'required',
                    'email'=>'email|nullable',
                    'telecom.*'=>'required|numeric',
                    'responsible_person_phone'=>'numeric|nullable',
                    'responsible_person_email'=>'email|nullable',
                    'accounts_dep_emp_phone'=>'numeric|nullable',
                    'accounts_dep_emp_email'=>'email|nullable',
                ];
    }

    public function messages()
    {
        $validationMessages =   [
                                    // 'code.required'=>' برجاء إدخال كود العميل. ',
                                    'sector.required'=>' برجاء إختيار قطع العمل الخاص بالعميل. ',
                                    'code.unique'=>' كود العميل تم إدخاله من قبل برجاء اختيار كود آخر. ',
                                    'name.required'=>' برجاء إدخال اسم العميل. ',
                                    'type.required'=>' برجاء أختيار نوع العميل. ',
                                    'email.email'=>' برجاء إدخال الإيمل بشكل صحيح. ',
                                    'responsible_person_phone.numeric'=>' برجاء ادخال رقم الهاتف للشخص المسؤول عن الآلة على هيئة ارقام فقط. ',
                                    'responsible_person_email.email'=>' برجاء ادخال البريد الإلكتروني للشخص المسؤول عن الآلة بشكل صحيح. ',
                                    'accounts_dep_emp_phone.numeric'=>' برجاء ادخال رقم الهاتف الخاص بقسم المحاسبة للعميل على هيئة ارقام فقط. ',
                                    'accounts_dep_emp_email.email'=>'  برجاء ادخال البريد الإلكتروني الخاص بقسم المحاسبة للعميل بشكل صحيح. ',
                                ];
        for($i = 0 ; $i < count($this->telecom) ;$i++){
            $validationMessages["telecom*$i.required"] = "برجاء إدخال رقم الهاتف للحقل رقم ".($i+1).'.';
        }
        return  $validationMessages;
    }
}
