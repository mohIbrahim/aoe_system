<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrintingMachineRequest extends FormRequest
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
            'code'=>'required',
            'folder_number'=>'required',
			'model_prefix'=>'required',
			'model_suffix'=>'required',
			'manufacturing_year'=>'numeric|nullable',
			'price_without_tax'=>'numeric|nullable',
			'price_with_tax'=>'numeric|nullable',
        ];
    }

	public function messages()
	{
		return [
			'folder_number.required'=>'برجاء إدخال رقم ملف الآلة.',
			'code.required'=> 'برجاء إدخال كود الآلة.',
			'model_prefix.required'=>'برجاء إدخال الموديل الجزء الأول.',
			'model_suffix.required'=>'برجاء إدخال الموديل الجزء الثاني.',
			'manufacturing_year.numeric'=>'برجاء إدخال سنة الصنع أرقام فقط.',
            'price_without_tax.numeric'=>' برجاء إدخال السعر بدون الضريبة أرقام فقط. ',
            'price_with_tax.numeric'=>' برجاء إدخال السعر بالضريبة أرقام فقط. ',
		];
	}
}
