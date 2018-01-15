<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
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
        return
            [
                'code'=>'required|unique:contracts,code,'.$this->contract,
                'type'=>'required',
                'start'=>'required|date',
                'end'=>'required|date|after:start',
                'status'=>'required',
                'price'=>'required|numeric',
                'tax'=>'required|numeric',
                'total_price'=>'required|numeric',
                'payment_system'=>'required',
            ];
    }

    public function messages()
    {
        return
            [
                'code.required'=>' برجاء إدخال كود العقد. ',
                'code.unique'=>' كود العقد تم إدخاله من قبل برجاء التأكد من القيمة المدخله. ',
                'type.required'=>' برجاء إدخال نوع العقد. ',
                'start.required'=>' برجاء إدخال تاريخ بداية التعاقد. ',
                'start.date'=>' إدخل تاريخ بداية التعاقد بشكل صحيح. ',
                'end.required'=>' برجاء إدخال تاريخ نهاية التعاقد. ',
                'end.date'=>' إدخل تاريخ نهاية التعاقد بشكل صحيح. ',
                'end.after'=>' تاريخ نهاية التعاقد يجب أن يكون بعد تاريخ بداية التعاقد. ',
                'status.required'=>' برجاء إختيار حالة التعاقد. ',
                'price.required'=>' برجاء إدخال السعر عند التعاقد. ',
                'price.numeric'=> ' برجاء إدخال قيمة سعر التعاقد بشكل صحيح. ',
                'tax.required'=>' برجاء إدخال قيمة الضريبة. ',
                'tax.numeric'=>' برجاء إدخال قيمة الضريبة بشكل صحيح. ',
                'total_price.required'=>' برجاء إدخال القيمة الإجمالية لسعر التعاقد. ',
                'total_price.numeric'=>' برجاء إدخال القيمة الإجمالية لسعر التعاقد بشكل صحيح. ',
                'payment_system.required'=>' برجاء إختيار نظام السداد. ',
            ];
    }
}
