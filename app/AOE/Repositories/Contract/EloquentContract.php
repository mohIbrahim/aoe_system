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
        if(isset($attributes['item_name']) && isset($attributes['item_description']))
            $this->createNoteOnContracting($contract, $attributes['item_name'] , $attributes['item_description']);
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

    public function paymentCount(Contract $contract)
    {
        $paymentSystem = $contract->payment_system;
        $count = 0;
        if ($paymentSystem == 'مقدم' || $paymentSystem == 'نهاية المدة') {
            $count = 1;         
        } else if ($paymentSystem == 'ربع سنوي') {
            $count = 4;            
        } else if ($paymentSystem == 'نصف سنوي') {
            $count = 2;            
        }
        return $count;
    }

    public function paymentsIsDueNamesAndDates($contract)
    {
        $contractStart = $contract->start;
        $contractEnd = $contract->end;
        $contractPaymentSystem = $contract->payment_system;
        $paymentsDates = [];
        $paymentsNames = [];

        if ( !empty($contractStart) && !empty($contractEnd) ) {
            $contractingYears = Carbon::parse($contractStart)->diffInYears(Carbon::parse($contractEnd));
            $contractingMonths = $contractingYears * 12;
            if ( $contractPaymentSystem == 'مقدم' ) {
                $paymentsDates[] = Carbon::parse($contractStart)->format('Y-m-d');
                $paymentsNames[] = 'دفعة واحدة فقط';
            } else if ( $contractPaymentSystem == 'نهاية المدة' ) {
                $paymentsDates[] = Carbon::parse($contractEnd)->format('Y-m-d');
                $paymentsNames[] = 'دفعة واحدة فقط';
            } else if ( $contractPaymentSystem == 'ربع سنوي' ) {
                $flag = 1;
                for ($i = 0; $i < $contractingMonths ; $i=$i+3) {
                    $paymentsDates[] = Carbon::parse($contractStart)->addMonths($i)->format('Y-m-d');
                    $paymentsNames[] = $this->paymentArabicNames()[$flag];
                    $flag++;
                }
            } else if ( $contractPaymentSystem == 'نصف سنوي' ) {
                $flag = 1;
                for ($i = 0; $i < $contractingMonths ; $i=$i+6) {
                    $paymentsDates[] = Carbon::parse($contractStart)->addMonths($i)->format('Y-m-d');
                    $paymentsNames[] = $this->paymentArabicNames()[$flag];
                    $flag++;
                }
            }
        }        
        return [$paymentsNames,$paymentsDates];
    }

    public function createInvoicesForNewContract($contract)
    {
        $contractStart = $contract->start;
        $contractEnd = $contract->end;
        $contractPaymentSystem = $contract->payment_system;
        $paymentsDates = [];
        $paymentsNames = [];

        if ( !empty($contractStart) && !empty($contractEnd) ) {
            $contractingYears = Carbon::parse($contractStart)->diffInYears(Carbon::parse($contractEnd));
            $contractingMonths = $contractingYears * 12;
            if ( $contractPaymentSystem == 'مقدم' ) {
                $paymentsDates[] = Carbon::parse($contractStart)->format('Y-m-d');
                $paymentsNames[] = 'دفعة واحدة فقط';
                $contract->invoice()->create(['number'=>null, 'type'=>'تعاقد', 'الأقسام الفنية', 'release_date'=>$contractStart, '']);
            } else if ( $contractPaymentSystem == 'نهاية المدة' ) {
                $paymentsDates[] = Carbon::parse($contractEnd)->format('Y-m-d');
                $paymentsNames[] = 'دفعة واحدة فقط';
            } else if ( $contractPaymentSystem == 'ربع سنوي' ) {
                $flag = 1;
                for ($i = 0; $i < $contractingMonths ; $i=$i+3) {
                    $paymentsDates[] = Carbon::parse($contractStart)->addMonths($i)->format('Y-m-d');
                    $paymentsNames[] = $this->paymentArabicNames()[$flag];
                    $flag++;
                }
            } else if ( $contractPaymentSystem == 'نصف سنوي' ) {
                $flag = 1;
                for ($i = 0; $i < $contractingMonths ; $i=$i+6) {
                    $paymentsDates[] = Carbon::parse($contractStart)->addMonths($i)->format('Y-m-d');
                    $paymentsNames[] = $this->paymentArabicNames()[$flag];
                    $flag++;
                }
            }
        }        
        return [$paymentsNames,$paymentsDates];
    }

    public function validContracts(){
        return $this->contract->where('start', '<=', now())
                                ->where('end', '>=', now())->get();
    }

    public function getPaymentsIsDueInThisMonth()
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
        $selectePaymentsNames = [];
        $selectePaymentsDates = [];
        $selecteContracts = [];
        foreach ($validContracts as $contractIterator => $contract) {
            $paymentsNamesAndDates = $this->paymentsIsDueNamesAndDates($contract);
            $paymentsNames = $paymentsNamesAndDates[0];
            $paymentsDates = $paymentsNamesAndDates[1];

            foreach ($paymentsDates as $paymentDateIterator => $paymentDate) {
                if ( (Carbon::parse($paymentDate)->gte($dateOfFistDayInThisMonthCarbon)) && 
                     (Carbon::parse($paymentDate)->lte($dateOfLastDayInThisMonthCarbon))
                    ) {
                    $selectePaymentsNames[] = $paymentsNames[$paymentDateIterator];
                    $selectePaymentsDates[] = $paymentDate;
                    $selecteContracts[] = $contract;
                }
            }
        }
        $paymentsIsDueInThisMonth = [$selectePaymentsNames, $selectePaymentsDates, $selecteContracts, $thisMonth, $thisYear];
        return $paymentsIsDueInThisMonth;
    }

    public function paymentArabicNames()
    {
        return [1=>'الدفعة الآولى', 2=>'الدفعة الثانية', 3=>'الدفعة الثالثة', 4=>'الدفعة الرابعة', 5=>'الدفعة الخامسة', 6=>'الدفعة السادسة', 7=>'الدفعة السابعة', 8=>'الدفعة الثامنة', 9=>'الدفعة التاسعة', 10=>'الدفعة العاشرة', 11=>'الدفعة الحادية عشرة', 12=>'الدفعة الثانية عشرة', 13=>'الدفعة الثالثة عشرة', 14=>'الدفعة الرابعة عشرة', 15=>'الدفعة الخامسة عشرة', 16=>'الدفعة السادسة عشرة', 17=>'الدفعة السابعة عشرة', 18=>'الدفعة الثامنة عشرة', 19=>'الدفعة التاسعة عشرة', 20=>'الدفعة العشرون'];
    }
}
