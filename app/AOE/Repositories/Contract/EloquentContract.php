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
                        ->orWhereBetween('start', [$keyword.' 00:00:00', $keyword.' 23:59:59'])
                        ->orWhereBetween('end', [$keyword.' 00:00:00', $keyword.' 23:59:59'])
                        ->orWhere('status', 'like', '%'.$keyword.'%')
                        ->orWhere('payment_system', 'like', '%'.$keyword.'%')
                        ->orWhere('price', 'like', '%'.$keyword.'%')
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
        if ((!empty($contract->start)) && (!empty($contract->end)) && (($contract->payment_system) != 'بدون')) {
            $contractStart              = $contract->start;
            $contractEnd                = $contract->end;
            $contractPaymentSystem      = $contract->payment_system;
            $periodBetweenEachPayment   = $contract->period_between_each_payment;

            $contractingYears           = Carbon::parse($contractStart)->diffInYears(Carbon::parse($contractEnd));
            $contractingYears           = ($contractingYears < 1)?(1):($contractingYears);

            $contractingMonths          = $contractingYears * 12;
            $contractTotalPrice         = $contract->total_price;

            $customerAndMaybeHisBranches     = [];
            $isAllSameCustomer          = true;
            //get all customers id for this machines
            foreach($contract->printingMachines as $printingMachine) {
                $customerAndMaybeHisBranches[] = $printingMachine->customer;
            }
            //check all printing machiens for same customer.
            foreach($customerAndMaybeHisBranches as $customer) {
                if (($customerAndMaybeHisBranches[0])->id !== $customer->id) {
                    $isAllSameCustomer = false;
                    break;
                }
            }
            
            $customerId                 = ($isAllSameCustomer)?($contract->printingMachines()->first()->customer->id):(null);

            // If the contract is for one customer and his printing machines
            if ($isAllSameCustomer) {
                if ( $contractPaymentSystem == 'مقدم' ) {
                    if ( $periodBetweenEachPayment == 13 ) {// دفعة واحدة
                        $contract->invoices()->create(['type'=>'تعاقد', 'release_date'=>$contractStart, 'total'=>$contractTotalPrice, 'customer_id'=>$customerId]);
                    } else { 
                        for ($i = 1 ; $i <= $contractingMonths ; $i+=$periodBetweenEachPayment) {
                            $contract->invoices()->create(['type'=>'تعاقد', 'release_date'=>(Carbon::parse($contractStart)->addMonths(($i-1))->format('Y-m-d')), 'total'=>(($contractTotalPrice)/($contractingMonths/$periodBetweenEachPayment )), 'customer_id'=>$customerId]);
                        }
                    }
                } else if ( $contractPaymentSystem == 'نهاية المدة' ) {
                    if ( $periodBetweenEachPayment == 13 ) { // دفعة وحدة
                        $contract->invoices()->create(['type'=>'تعاقد', 'release_date'=>(Carbon::parse($contractEnd)->addMonths(1)->format('Y-m-d')), 'total'=>$contractTotalPrice, 'customer_id'=>$customerId]);
                    } else {
                        for ($i = 1 ; $i <= $contractingMonths ; $i+=$periodBetweenEachPayment) {
                            $contract->invoices()->create(['type'=>'تعاقد', 'release_date'=>(Carbon::parse($contractStart)->addMonths(($i+$periodBetweenEachPayment-1))->format('Y-m-d')), 'total'=>(($contractTotalPrice)/($contractingMonths/$periodBetweenEachPayment )), 'customer_id'=>$customerId]);
                        }
                    }
                }
            } else { //If the contract is for one customer and some of his branches and their printing machines
                $custoemrBranches = [];
                if (!$isAllSameCustomer) {
                    $custoemrBranches = array_unique($customerAndMaybeHisBranches, SORT_REGULAR);
                }
                foreach ($custoemrBranches as $customerBranch) {
                    if ( $contractPaymentSystem == 'مقدم' ) {
                        if ( $periodBetweenEachPayment == 13 ) {// دفعة واحدة
                            $contract->invoices()->create(['type'=>'تعاقد', 'release_date'=>$contractStart, 'customer_id'=>$customerBranch->id]);
                        } else { 
                            for ($i = 1 ; $i <= $contractingMonths ; $i+=$periodBetweenEachPayment) {
                                $contract->invoices()->create(['type'=>'تعاقد', 'release_date'=>(Carbon::parse($contractStart)->addMonths(($i-1))->format('Y-m-d')), 'customer_id'=>$customerBranch->id]);
                            }
                        }
                    } else if ( $contractPaymentSystem == 'نهاية المدة' ) {
                        if ( $periodBetweenEachPayment == 13 ) { // دفعة وحدة
                            $contract->invoices()->create(['type'=>'تعاقد', 'release_date'=>(Carbon::parse($contractEnd)->addMonths(1)->format('Y-m-d')), 'customer_id'=>$customerBranch->id]);
                        } else {
                            for ($i = 1 ; $i <= $contractingMonths ; $i+=$periodBetweenEachPayment) {
                                $contract->invoices()->create(['type'=>'تعاقد', 'release_date'=>(Carbon::parse($contractStart)->addMonths(($i+$periodBetweenEachPayment-1))->format('Y-m-d')), 'customer_id'=>$customerBranch->id]);
                            }
                        }
                    }
                }
            }
        }
    }

    public function validContracts(){
        return $this->contract->where('start', '<=', now())
                                ->where('end', '>=', now())->get();
    }
    //Reporting
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
        
        foreach ($validContracts as $contractKey => $contract) {
            // foreach ($contract->invoices as $invoiceKey => $invoice ) {
            foreach ($contract->invoices()->whereNotNull('release_date')->get() as $invoiceKey => $invoice ) {
                if (Carbon::parse($invoice->release_date)->isSameMonth(now())) {
                    $selectedContracts[] = $contract;
                    $selectedInvoices[] = $invoice;
                }
            }
        }
        $paymentsIsDueInThisMonth = [$selectedInvoices, $selectedContracts, $thisMonth, $thisYear];
        return $paymentsIsDueInThisMonth;
    }

    public function paymentArabicNames()
    {
        return [1=>'الدفعة الآولى', 2=>'الدفعة الثانية', 3=>'الدفعة الثالثة', 4=>'الدفعة الرابعة', 5=>'الدفعة الخامسة', 6=>'الدفعة السادسة', 7=>'الدفعة السابعة', 8=>'الدفعة الثامنة', 9=>'الدفعة التاسعة', 10=>'الدفعة العاشرة', 11=>'الدفعة الحادية عشرة', 12=>'الدفعة الثانية عشرة', 13=>'الدفعة الثالثة عشرة', 14=>'الدفعة الرابعة عشرة', 15=>'الدفعة الخامسة عشرة', 16=>'الدفعة السادسة عشرة', 17=>'الدفعة السابعة عشرة', 18=>'الدفعة الثامنة عشرة', 19=>'الدفعة التاسعة عشرة', 20=>'الدفعة العشرون'];
    }

    public function getContractsThatWillExpireWithinTheNextThreeMonthes()
    {
        $now = Carbon::now();
        $nextThreeMonthes = Carbon::now()->addQuarter();
        $results = $this->contract->whereBetween('end',[$now, $nextThreeMonthes])->oldest('end')->get();
        return $results;
    }

    private function isContractAreNotExpired($contractingEndingDate)
    {
        $carbonDate = (new Carbon())->parse($contractingEndingDate);
        $carbonNow = Carbon::now();
        if (  $carbonDate->gte($carbonNow)  ) {
            return true;
        }
        return false;
    }

    public function getContractsReleasedOrEndDuringACertainPeriodReportSearch($from, $to, $isEndDate)
    {
        $startOrEnd = ($isEndDate == "true")?('end'):('start');
        $results = Contract::with('printingMachines.customer')->whereBetween($startOrEnd, [$from, $to])->get();
        return $results;
    }
}
