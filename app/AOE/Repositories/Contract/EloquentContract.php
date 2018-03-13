<?php

namespace App\AOE\Repositories\Contract;

use App\Contract;

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

    public function paymentIsDue($contract)
    {
        $paymentCount = $this->paymentCount($contract);
        $numberOfPayedInvoices = $contract->invoices()->count();
        if ($paymentCount == $numberOfPayedInvoices) {
            //All invoice is payed
        }
        if ($paymentCount > $numberOfPayedInvoices) {
            $countOfRemainingPayments = $paymentCount - $numberOfPayedInvoices;
            $latestPayedInvoice = $contract->invoices()->latest()->first();        
            $dateOfLatestPayedInvoice = $latestPayedInvoice->collectDate;

            
        }
        return $latestPayedInvoice;
    }
}
