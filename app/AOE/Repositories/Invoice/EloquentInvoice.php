<?php

namespace App\AOE\Repositories\Invoice;

use App\Invoice;
use App\Part;
use App\Http\Requests\InvoiceRequest;

class EloquentInvoice implements InvoiceInterface
{
    private $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }
    public function getAll()
    {
        $invoices = $this->invoice->all();
        return $invoices;
    }
    public function latest()
    {
        $invoices = $this->invoice->latest();
        return $invoices;
    }
    public function oldest()
    {
        $invoices = $this->invoice->oldest();
        return $invoices;
    }
    public function getById($id)
    {
        $invoice = $this->invoice->findOrFail($id);
        return $invoice;
    }
    public function create(array $attributes)
    {
        $invoice = $this->invoice->create($attributes);
        return $invoice;
    }
    public function update($id, array $attributes)
    {
        $invoice = $this->invoice->findOrFail($id);
        $invoice->update($attributes);
        return $invoice;
    }
    public function delete($id)
    {
        $invoice = $this->invoice->findOrFail($id);
        $isDeleted = $invoice->delete();
        return $isDeleted;
    }

    public function search($keyword)
    {
        $results = $this->invoice->with('customer')->where('number', 'like', '%'.$keyword.'%')
                        ->orWhere('type', 'like', '%'.$keyword.'%')
                        ->orWhere('finance_check_out', 'like', '%'.$keyword.'%')
                        ->orWhere('release_date', 'like', '%'.$keyword.'%')
                        ->orWhereHas('customer', function($query) use($keyword){
                            $query->where('name', 'like', '%'.$keyword.'%');
                        })
                        ->get();
        return $results;
    }

    public function searchFormPart($keyword)
    {
        $results = Part::where('name', 'like', '%'.$keyword.'%')
                                ->limit(15)
                                ->get();
        return $results;
    }

    public function attachSellingParts(InvoiceRequest $request, Invoice $invoice)
    {
        $pritingMachinesSerial  = $request->printing_machines_serial;
        $partsIds               = ($request->parts_ids)?($request->parts_ids):([]);
        $partsPrices            = $request->parts_prices;
        $partsSerial            = $request->parts_serial_numbers;
        $partcount              = $request->parts_count;
        $discountRate           = $request->discount_rate;
        $pivotArray = [];
        for ($i=0; $i < count($partsIds); $i++) {
            $pivotArray[$partsIds[$i]] =    [
                                                'printing_machines_serial'=>$pritingMachinesSerial,
                                                'price'=>$partsPrices[$i],
                                                'part_serial_number'=>$partsSerial[$i],
                                                'number_of_parts'=>$partcount[$i],
                                                'discount_rate'=>$discountRate[$i],
                                            ];
                                    
        }
        $invoice->sellingParts()->sync($pivotArray);
    }

    public function preparationInvoiceItemsForShowView(Invoice $invoice)
    {
        $results = [];
        $type = $invoice->type; 
        if ($type == 'تعاقد') {
            $contract = $invoice->contract;
            $results[] =    [   'rowNumber'=>1,
                                'itemId'=>$contract->id,
                                'itemName'=>'عقد '.$contract->type.' رقم: '.$contract->code,
                                'itemCount'=>1,
                                'itemPrice'=>$contract->price,
                                'totalItemsPricePerRow'=>$contract->price,
                                'discount'=>0,
                            ];
        } else if ($type == 'مقايسة') {
            $parts = $invoice->indexation->parts->toArray();
            $indexationId = $invoice->indexation->id;
            foreach ($parts as $key=>$part) {
                $results[] =    [   'rowNumber'=>$key+1,
                                    'itemId'=>$part['id'],
                                    'itemName'=>$part['name'],
                                    'itemCount'=>$part['pivot']['number_of_parts'],
                                    'itemPrice'=>$part['pivot']['price'],
                                    'totalItemsPricePerRow'=>$part['pivot']['number_of_parts']*$part['pivot']['price'],
                                    'discount'=>$part['pivot']['discount_rate'],
                                    'indexationId'=>$indexationId,
                                ];
            }
        } else if ($type == 'بيع قطع') {
            $parts = $invoice->sellingParts->toArray();
            foreach ($parts as $key=>$part) {
                $results[] =    [   'rowNumber'=>$key+1,
                                    'itemId'=>$part['id'],
                                    'itemName'=>$part['name'],
                                    'itemCount'=>$part['pivot']['number_of_parts'],
                                    'itemPrice'=>$part['pivot']['price'],
                                    'totalItemsPricePerRow'=>$part['pivot']['number_of_parts']*$part['pivot']['price'],
                                    'discount'=>$part['pivot']['discount_rate'],
                                ];
            }
        }
        return $results;
    }
}
