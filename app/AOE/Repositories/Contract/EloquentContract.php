<?php

namespace App\AOE\Repositories\Contract;

use App\Contract;
use Carbon\Carbon;

class EloquentContract implements ContractInterface
{
    private $contract;

    public function __construct(Contract $contract)
    {
        $this->contract = $contract;
    }
    public function getAll()
    {
        $contracts = $this->contract->all();
        return $contracts;
    }
    public function latest()
    {
        $contracts = $this->contract->latest();
        return $contracts;
    }
    public function oldest()
    {
        $contracts = $this->contract->oldest();
        return $contracts;
    }
    public function getById($id)
    {
        $contract = $this->contract->findOrFail($id);
        return $contract;
    }
    public function create(array $attributes)
    {
        $contract = $this->contract->create($attributes);
        if (isset($attributes['item_name']) && isset($attributes['item_description'])) {
            $this->createNoteOnContracting($contract, $attributes['item_name'] , $attributes['item_description']);
        }
        $contract->code = $contract->id;
        $contract->save();
        return $contract;
    }
    public function update($id, array $attributes)
    {
        $contract = $this->contract->findOrFail($id);
        $contract->update($attributes);
        
        $contract->notesOnContracting()->delete();
        if(isset($attributes['item_name']) && isset($attributes['item_description']))
            $this->createNoteOnContracting($contract, $attributes['item_name'] , $attributes['item_description']);
            
        return $contract;
    }

    public function delete($id)
    {
        $contract = $this->contract->findOrFail($id);
        $isDeleted = $contract->delete();
        return $isDeleted;
    }

    public function search($keyword)
    {
        $results = $this->contract->with('printingMachines.customer')->where('code', 'like', '%'.$keyword.'%')
                        ->orWhere('type', 'like', '%'.$keyword.'%')
                        ->orWhereHas('printingMachines', function($query)use($keyword){
                            $query->whereHas('customer', function($query1) use($keyword){
                                $query1->where('name', 'like', '%'.$keyword.'%');
                            });
                        })
                        ->get();
        return $results;
    }

    public function createNoteOnContracting(Contract $contract, array $itemsNames, array $itmesDescriptions)
    {
        if (null !== ($itmesDescriptions) &&  null !== ($itemsNames)) {
            $itemNameArr = $itemsNames;
            $itemDescriptionArr = $itmesDescriptions;

            if ( count($itemNameArr) == count($itemDescriptionArr) ) {
                foreach ($itemNameArr as $itemNameIterator => $itemName) {
                    $contract->notesOnContracting()->create(['item_name'=>$itemName, 'item_description'=>$itemDescriptionArr[$itemNameIterator]]);
                }
            }
            return true;
        } else {
            return false;
        }

    }    

    public function createInvoicesForNewContract($contract)
    {
        if (!empty($contract->start) && !empty($contract->end)) {
            $contractStart = $contract->start;
            $contractEnd = $contract->end;
            $contractPaymentSystem = $contract->payment_system;
            $contractingYears = Carbon::parse($contractStart)->diffInYears(Carbon::parse($contractEnd));
            $contractingMonths = $contractingYears * 12;
            $contractTotalPrice = $contract->total_price;
            $customerId = $contract->printingMachines()->first()->customer->id;

            if ( $contractPaymentSystem == 'مقدم' ) {
                $contract->invoices()->create(['type'=>'تعاقد', 'release_date'=>$contractStart, 'total'=>(($contractTotalPrice)/($contractingYears * 1)), 'customer_id'=>$customerId]);
            } else if ( $contractPaymentSystem == 'نهاية المدة' ) {
                $contract->invoices()->create(['type'=>'تعاقد', 'release_date'=>$contractEnd, 'total'=>(($contractTotalPrice)/($contractingYears * 1)), 'customer_id'=>$customerId]);
            } else if ( $contractPaymentSystem == 'ربع سنوي' ) {
                for ($i = 0; $i < $contractingMonths ; $i=$i+3) {
                    $contract->invoices()->create(['type'=>'تعاقد', 'release_date'=>(Carbon::parse($contractStart)->addMonths($i)->format('Y-m-d')), 'total'=>(($contractTotalPrice)/($contractingYears * 4)), 'customer_id'=>$customerId]);
                }
            } else if ( $contractPaymentSystem == 'نصف سنوي' ) {
                for ($i = 0; $i < $contractingMonths ; $i=$i+6) {
                    $contract->invoices()->create(['type'=>'تعاقد', 'release_date'=>(Carbon::parse($contractStart)->addMonths($i)->format('Y-m-d')), 'total'=>(($contractTotalPrice)/($contractingYears * 2)), 'customer_id'=>$customerId]);
                }
            }            
            return true;
        }
        return false;
    }

    public function validContracts(){
        return $this->contract->where('start', '<=', now())
                                ->where('end', '>=', now())->get();
    }

    public function getContractsInvoicesAreDueInThisMonthReportData()
    {
        $paymentsIsDueInThisMonth = null;
        $thisYear = now()->year;
        $thisMonth = now()->month;
        $daysInThisMonth = now()->daysInMonth;

        $dateOfFirstDayInThisMonth = $thisYear.'-'.$thisMonth.'-1';
        $dateOfFistDayInThisMonthCarbon = Carbon::parse($dateOfFirstDayInThisMonth);

        $dateOfLastDayInThisMonth = $thisYear.'-'.$thisMonth.'-'.$daysInThisMonth;
        $dateOfLastDayInThisMonthCarbon = Carbon::parse($dateOfLastDayInThisMonth);
        
        $validContracts = $this->validContracts();
        $selectedContracts = [];
        $selectedInvoices = [];
        $selectePaymentsNames = [];
        foreach ($validContracts as $contractKey => $contract) {
            foreach ($contract->invoices as $invoiceKey => $invoice ) {
                if ( (Carbon::parse($invoice->release_date)->gte($dateOfFistDayInThisMonthCarbon)) && 
                     (Carbon::parse($invoice->release_date)->lte($dateOfLastDayInThisMonthCarbon))
                    ) {
                        $selectedContracts[] = $contract;
                        $selectedInvoices[] = $invoice;
                        $selectePaymentsNames[] = $this->paymentArabicNames()[($invoiceKey+1)];
                }
            }
        }
        $paymentsIsDueInThisMonth = [$selectePaymentsNames, $selectedInvoices, $selectedContracts, $thisMonth, $thisYear];
        return $paymentsIsDueInThisMonth;
    }

    public function paymentArabicNames()
    {
        return [1=>'الدفعة الآولى', 2=>'الدفعة الثانية', 3=>'الدفعة الثالثة', 4=>'الدفعة الرابعة', 5=>'الدفعة الخامسة', 6=>'الدفعة السادسة', 7=>'الدفعة السابعة', 8=>'الدفعة الثامنة', 9=>'الدفعة التاسعة', 10=>'الدفعة العاشرة', 11=>'الدفعة الحادية عشرة', 12=>'الدفعة الثانية عشرة', 13=>'الدفعة الثالثة عشرة', 14=>'الدفعة الرابعة عشرة', 15=>'الدفعة الخامسة عشرة', 16=>'الدفعة السادسة عشرة', 17=>'الدفعة السابعة عشرة', 18=>'الدفعة الثامنة عشرة', 19=>'الدفعة التاسعة عشرة', 20=>'الدفعة العشرون'];
    }
}
