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
        $rules =    [
                        'type'=>'required',
                        'start'=>'required|date',
                        'end'=>'required|date|after:start',
                        'status'=>'required',
                        'price'=>'required|numeric',
                        'tax'=>'required|numeric|max:100',
                        'total_price'=>'required|numeric',
                        'payment_system'=>'required',
                        'contract_as_pdf'=>'mimes:pdf',
                        'assigned_machines_ids'=>'required',
                    ];
                    
        if( $this->payment_system != 'بدون') {
            $rules['period_between_each_payment'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return
            [
                'type.required'=>' برجاء إدخال نوع العقد. ',
                'start.required'=>' برجاء إدخال تاريخ بداية التعاقد. ',
                'start.date'=>' إدخل تاريخ بداية التعاقد بشكل صحيح. ',
                'end.required'=>' برجاء إدخال تاريخ نهاية التعاقد. ',
                'end.date'=>' إدخل تاريخ نهاية التعاقد بشكل صحيح. ',
                'end.after'=>' تاريخ نهاية التعاقد يجب أن يكون بعد تاريخ بداية التعاقد. ',
                'status.required'=>' برجاء اختيار حالة التعاقد. ',
                'price.required'=>' برجاء إدخال السعر عند التعاقد. ',
                'price.numeric'=> ' برجاء إدخال قيمة سعر التعاقد بشكل صحيح. ',
                'tax.required'=>' برجاء إدخال قيمة الضريبة. ',
                'tax.numeric'=>' برجاء إدخال قيمة الضريبة بشكل صحيح. ',
                'tax.max'=>' برجاء إدخال قيمة الضريبة لا تزيد عن 100. ',
                'total_price.required'=>' برجاء إدخال القيمة الإجمالية لسعر التعاقد. ',
                'total_price.numeric'=>' برجاء إدخال القيمة الإجمالية لسعر التعاقد بشكل صحيح. ',
                'payment_system.required'=>' برجاء اختيار نظام السداد. ',
                'period_between_each_payment.required'=>' برجاء اختيار المدة بين كل دفعة ',
                'contract_as_pdf.mimes'=>' برجاء اختيار صورة العقد بأمتداد PDF.',
				'assigned_machines_ids.required'=>' برجاء اختيار آلات التصوير المعينة لهذا العقد. ',
            ];
    }
}
