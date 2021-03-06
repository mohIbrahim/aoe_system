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
        $customerId = $this->input('customer_id');

        if ($this->type === 'تعاقد') {
            $result['contract_id']  = 'required';

            $contract = (\App\Contract::findOrFail($this->input('contract_id')));
            if (!empty($contract)) {
                $customersIdsForAnContract = [];
                $contractPrintingMachines = $contract->printingMachines;
                foreach ($contractPrintingMachines as $key => $contractPrintingMachine) {
                    $customersIdsForAnContract[] = ($contractPrintingMachine->customer)?($contractPrintingMachine->customer->id):(null);
                }
            }
            if(!in_array($customerId, $customersIdsForAnContract))
                $result['restrictNotSameFormCustomerAndContractCustomer'] = 'required';
        }
        
        if ($this->type === 'مقايسة') {
            $result['indexation_id']  = 'required';

            $customerOfindexation = null;
            if ((\App\Indexation::findOrFail($this->input('indexation_id')))->type == 'تليفونية')
                $customerOfindexation = (\App\Indexation::findOrFail($this->input('indexation_id')))->printingMachine->customer->id;
            if ((\App\Indexation::findOrFail($this->input('indexation_id')))->type == 'زيارة')
                $customerOfindexation = (\App\Indexation::findOrFail($this->input('indexation_id')))->visit->printingMachine->customer->id;
            
            if($customerId != $customerOfindexation)
                $result['restrictNotSameFormCustomerAndIndexationCustomer'] = 'required';
        }

        if ($this->type === 'بيع قطع') {
            $result['parts_ids']  = 'required';
        }

        return $result;
    }

    public function messages()
    {
        return [
            'number.required'=>' برجاء إدخال رقم الفاتورة. ',
            'number.max'=>' برجاء إدخال رقم الفاتورة لا يزيد عن 7 خانات. ',
            'number.numeric'=>' برجاء إدخال رقم الفاتور أرقم فقط. ',
            'number.unique'=>' رقم الفاتورة تم إدخاله من قبل برجاء اختيار رقم آخر. ',

            'customer_id.required'=>' برجاء اختيار كود العميل. ',
            'restrictNotSameFormCustomerAndIndexationCustomer.required'=>'كود المقايسة لا يناسب العميل الذي تم إختيارة برجاء التأكد من البيانات المدخله',
            'restrictNotSameFormCustomerAndContractCustomer.required'=>'كود العقد لا يناسب العميل الذي تم إختيارة برجاء التأكد من البيانات المدخله',

            'type.required'=>' برجاء اختيار نوع الفاتورة. ',

            'contract_id.required'=>' برجاء اختيار كود العقد. ',

            'indexation_id.required'=>' برجاء اختيار كود المقايسة. ',

            'parts_ids.required'=>' برجاء اختيار قطع الآلة مراد إضافتها للفاتورة. ',

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
