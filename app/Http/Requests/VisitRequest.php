<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitRequest extends FormRequest
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
        $results = [
            'type'=>'required',
            'printing_machine_id'=>'required',
            'visit_date'=>'required|date',
            'the_employee_who_made_the_visit_id'=>'required',
            'readings_of_printing_machine'=>'required|numeric',
        ];
        if ($this->type == 'بطاقة المتابعة') {
            $results['follow_up_card_id'] = 'required';
        }
        if ($this->type == 'إشارة') {
            $results['reference_id'] = 'required';
        }
        return $results;
    }

    /**
     * [messages description]
     * @return [type] [description]
     */
    public function messages()
    {
        return [
            'type.required'=>' برجاء اختيار نوع الزيارة. ',
            'follow_up_card_id.required'=>' برجاء اختيار كود بطاقة المتابعة. ',
            'reference_id.required'=>' برجاء اختيار كود الإشارة. ',
            'printing_machine_id.required'=>' برجاء اختيار كود الآلة التصوير. ',
            'visit_date.required'=>' برجاء إدخال تاريخ الزيارة. ',
            'visit_date.date'=>' برجاء إدخال تاريخ الزيارة بشكل صحيح. ',
            'the_employee_who_made_the_visit_id.required'=>' برجاء اختار اسم المهندس الذي قام بالزيارة. ',
            'readings_of_printing_machine.required'=>' برجاء إدخال قراءة العداد. ',
            'readings_of_printing_machine.numeric'=>' برجاء إدخال قراءة العداد أرقام فقظ ',
        ];
    }

}
