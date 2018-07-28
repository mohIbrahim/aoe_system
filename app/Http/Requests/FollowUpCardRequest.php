<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Contract;

class FollowUpCardRequest extends FormRequest
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
                        'printing_machine_id'=>'required',
                        'contract_id'=>'required',
                        'follow_up_card_as_pdf'=>'mimes:pdf',
                    ];

        $contractId = $this->input('contract_id');
        $printingMachineId = $this->input('printing_machine_id');
        $relatedPrintingMachinesIds = $this->getRelatedPrintingMachinesIdsToTheContract($contractId);
        if (!in_array($printingMachineId, $relatedPrintingMachinesIds)) {
            $results['printingMachineNotBelongsToTheContract'] = 'required';
        }
        return $results;
    }

    public function messages()
    {
        return [
            'code.unique'=>' برجاء إختار كود آخر للبطاقة هذا الكود تم إدخاله من قبل. ',
            'printing_machine_id.required'=>' برجاء اختيار الآلة الخاصة بهذة البطاقة. ',
            'contract_id.required'=>' برجاء اختيار العقد. ',
            'follow_up_card_as_pdf.mimes'=>' برجاء اختيار صورة بطاقة المتابعة بأمتداد PDF.',

            'printingMachineNotBelongsToTheContract.required'=>' الآلة المختارة لا تنتمي لهذا العقد. برجاء التوفيف بين كلا العقد والآلة المختارتين. ',
        ];
    }

    private function getRelatedPrintingMachinesIdsToTheContract($contractId)
    {
        $printingMachineIds = [];
        $relatedPrintingMachines = Contract::findOrFail($contractId)->printingMachines;
        if ($relatedPrintingMachines->isNotEmpty()) {
            foreach ($relatedPrintingMachines as $printingMachine) {
                $printingMachineIds[] = $printingMachine->id;
            }
        }
        return $printingMachineIds;
    }
}
