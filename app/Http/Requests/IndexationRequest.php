<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexationRequest extends FormRequest
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
                        'the_date'=>'required|date',
                        'type'=>'required',
                        'performed_employee_id'=>'required',
                        'upload_files_pdf.*'=>'mimes:pdf',
                        'upload_files_img.*'=>'mimes:jpeg,bmp,png',

                        'parts_prices.*'=>'nullable|numeric',
                        'parts_count.*'=>'nullable|numeric',
                        'discount_rate.*'=>'nullable|numeric|min:0|max:100',
                    ];
        if ($this->input('type') == 'تليفونية') {
            $results['printing_machine_id'] ='required';
        } elseif ($this->input('type') == 'زيارة') {
            $results['visit_id'] = 'required|unique:indexations,visit_id,'.$this->indexation;
        }
        
        return $results;
    }


    public function messages()
    {
        return [
            'the_date.required'=>' برجاء اختيار تاريخ المقايسة. ',
            'the_date.date'=>' برجاء إدخال التاريخ بشكل صحيح. ',
            'visit_id.required'=>' برجاء اختيار رقم الزيارة. ',
            'type.required'=>' برجاء إختيار نوع المقايسة ',
            'performed_employee_id.required'=>' برجاء إختيار اسم المهندس الذي قام بالمقايسة ',
            'visit_id.unique'=>'  رقم الزيارة تم اختياره من قبل برجاء اختيار رقم آخر. ',
            'printing_machine_id.required'=>'  برجاء إختيار الآلة. ',
            'upload_files_pdf.*.mimes'=> ' برجاء اختيار ملف المقايسة بأمتداد pdf. ',
            'upload_files_img.*.mimes'=> ' برجاء اختيار ملف المقايسة بأمتداد JPG, JPEG. ',
            
            'parts_prices.*.numeric'=>' برجاء إدخال السعر للقطع المختارة أرقام فقط. ',
            'parts_count.*.numeric'=>' برجاء إدخال العدد للقطع المختارة أرقام فقط. ',
            'discount_rate.*.numeric'=>' نسبة الخصم على القطعة الواحدة يجب أن تكون رقم محصور بين الصفر والمئة. ',
            'discount_rate.*.min'=>' نسبة الخصم على القطعة الواحدة يجب أن تكون رقم محصور بين الصفر والمئة. ',
            'discount_rate.*.max'=>' نسبة الخصم على القطعة الواحدة يجب أن تكون رقم محصور بين الصفر والمئة. ',
        ];
    }
}
