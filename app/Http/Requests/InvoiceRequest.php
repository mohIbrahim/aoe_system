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

        return [
            'number'=>'required|max:16777215|numeric',
            'order_number'=>'numeric|max:16777215|nullable',
            'delivery_permission_number'=>'numeric|max:16777215|nullable',
            'release_date'=>'required|date',
        ];
    }

    public function messages()
    {
        return [
            'number.required'=>' برجاء إدخال رقم الفاتورة. ',
            'number.max'=>' برجاء إدخال رقم الفاتورة لا يزيد عن 7 خانات. ',
            'number.numeric'=>' برجاء إدخال رقم الفاتور أرقم فقط. ',

            'order_number.numeric'=>' برجاء إدخال أمر توريد أرقم فقط. ',
            'order_number.max'=>' برجاء إدخال أمر توريد لا يزيد عن 7 خانات. ',

            'delivery_permission_number.numeric'=>' برجاء إدخال إذن تسليم أرقم فقط. ',
            'delivery_permission_number.max'=>' برجاء إدخال إذن تسليم لا يزيد عن 7 خانات. ',

            'release_date.required'=>' برجاء إدخال تاريخ الإصدار. ',
            'release_date.date'=>' برجاء إدخال تاريخ الإصدار بشكل صحيح. '
        ];
    }
}
