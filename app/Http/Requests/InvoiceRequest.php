<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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

        $result = [
            'number'=>'required|max:16777215|numeric|unique:invoices,number,'.$this->invoice,
            'customer_id'=>'required',
            'type'=>'required',
            'issuer'=>'required',
            'order_number'=>'numeric|max:16777215|nullable',
            'delivery_permission_number'=>'numeric|max:16777215|nullable',
            'release_date'=>'required|date',
            'indexation_id'=>'nullable|unique:invoices,indexation_id,'.$this->invoice,
			'total'=>'required|numeric',
        ];

        if ($this->type === 'تعاقد') {
            $result['contract_id']  = 'required';
        }

        if ($this->type === 'مقايسة') {
            $result['indexation_id']  = 'required';
        }

        return $result;
    }

    public function messages()
    {
        return [
            'number.required'=>' برجاء إدخال رقم الفاتورة. ',
            'number.max'=>' برجاء إدخال رقم الفاتورة لا يزيد عن 7 خانات. ',
            'number.numeric'=>' برجاء إدخال رقم الفاتور أرقم فقط. ',
            'number.uniuqe'=>' رقم الفاتورة تم إدخاله من قبل برجاء اختيار رقم آخر. ',

            'customer_id.required'=>' برجاء اختيار كود العميل. ',

            'type.required'=>' برجاء اختيار نوع الفاتورة. ',

            'contract_id.required'=>' برجاء اختيار كود العقد. ',

            'indexation_id.required'=>' برجاء اختيار كود المقايسة. ',

            'issuer.required'=>' برجاء اختيار جهة الإصدار. ',

            'order_number.numeric'=>' برجاء إدخال أمر توريد أرقم فقط. ',
            'order_number.max'=>' برجاء إدخال أمر توريد لا يزيد عن 7 خانات. ',

            'delivery_permission_number.numeric'=>' برجاء إدخال إذن تسليم أرقم فقط. ',
            'delivery_permission_number.max'=>' برجاء إدخال إذن تسليم لا يزيد عن 7 خانات. ',

            'release_date.required'=>' برجاء إدخال تاريخ الإصدار. ',
            'release_date.date'=>' برجاء إدخال تاريخ الإصدار بشكل صحيح. ',

            'indexation_id.unique'=>' عفواً هذة المقايسة تم إخراج فاتورة لها من قبل برجاء اختيار كود مقايسة آخر. ',
			'total.required'=>' برجاء إدخال القيمة الكلية للفاتورة. ',
			'total.numeric'=>' برجاء إدخال القيمة الكلية للفاتورة أرقام فقط. ',
        ];
    }
}
