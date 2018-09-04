<?php

namespace App\AOE\Repositories\Invoice;

use App\Invoice;
use App\Part;
use App\Http\Requests\InvoiceRequest;
use App\Customer;

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
        $results = $this->invoice->with('customer', 'employeesResponisableForThisInvoice.user')->where('number', 'like', '%'.$keyword.'%')
                        ->orWhere('type', 'like', '%'.$keyword.'%')
                        ->orWhere('issuer', $keyword)
                        ->orWhere('order_number', 'like', '%'.$keyword.'%')
                        ->orWhere('delivery_permission_number', 'like', '%'.$keyword.'%')
                        ->orWhere('finance_check_out', 'like', '%'.$keyword.'%')
                        ->orWhere('finance_check_out', 'like', '%'.$keyword.'%')
                        ->orWhere('total', 'like', '%'.$keyword.'%')
                        ->orWhereBetween('release_date', [$keyword.' 00:00:00', $keyword.' 23:59:59'])
                        ->orWhere('collect_date', 'like', '%'.$keyword.'%')
                        ->orWhereHas('customer', function($query) use($keyword){
                            $query->where('name', 'like', '%'.$keyword.'%');
                        })
                        ->orWhereHas('employeesResponisableForThisInvoice', function($query) use($keyword){
                            $query->whereHas('user', function($query) use($keyword){
                                $query->where('name', 'like', "%$keyword%");
                            });
                        })
                        ->get();
       ;
        foreach($results as  $key=>$result) {
            $result->employeesNamesThatAreResponsibleOnThisInvoice = $result->employeesNamesThatAreResponsibleOnThisInvoice;
            
            // dd($result);
        }
        return $results;
    }

    public function searchFormPart($keyword)
    {
        $results = Part::where('name', 'like', '%'.$keyword.'%')
                                ->limit(15)
                                ->get();
        return $results;
    }

    public function invoiceFormCustomerSearch($keyword)
    {
        $results = Customer::where('name', 'like', '%'.$keyword.'%')->limit(30)->get(['id', 'name', 'code']);
        return $results;
    }

    public function attachSellingParts(InvoiceRequest $request, Invoice $invoice)
    {
        $pritingMachinesSerial  = $request->printing_machines_serial;
        $partsIds               = ($request->parts_ids)?($request->parts_ids):([]);
        $partsPricesWithoutTax  = $request->parts_prices_without_tax;
        $partsPrices            = $request->parts_prices;
        $partsSerial            = $request->parts_serial_numbers;
        $partcount              = $request->parts_count;
        $discountRate           = $request->discount_rate;
        $partDescription        = $request->parts_descriptions;
        $pivotArray = [];
        for ($i=0; $i < count($partsIds); $i++) {
            $pivotArray[$partsIds[$i]] =    [
                                                'price_without_tax'=>$partsPricesWithoutTax[$i],
                                                'printing_machines_serial'=>$pritingMachinesSerial,
                                                'price'=>$partsPrices[$i],
                                                'part_serial_number'=>$partsSerial[$i],
                                                'number_of_parts'=>$partcount[$i],
                                                'discount_rate'=>$discountRate[$i],
                                                'part_description'=>$partDescription[$i],
                                            ];
                                    
        }
        $invoice->sellingParts()->sync($pivotArray);
    }

    public function preparationInvoiceItemsForShowView(Invoice $invoice)
    {
        $type = $invoice->type;
        if ($type == 'تعاقد') {
            $contract = $invoice->contract;
            $results[] =    [   'rowNumber'=>1,
                                'itemId'=>$contract->id,
                                'itemName'=>'عقد '.$contract->type.' رقم: '.$contract->code,
                                'itemCount'=>1,
                                'itemPriceWithoutTax'=>$contract->price,
                                'itemPrice'=>$contract->total_price,
                                'totalItemsPricePerRow'=>$contract->total_price,
                            ];
            return [$results];
        } else if ($type == 'مقايسة') {
            return $invoice->indexation->statementOfRequiredParts($invoice->indexation);
        } else if ($type == 'بيع قطع') {
            return $invoice->statementOfRequiredParts($invoice);
        }
    }

    public function invoicesReleasedInSpecificPeriodReportSearch($from, $to)
    {
        $results = $this->invoice->with('customer', 'employeeResponisableForThisInvoice.user')->whereNotNull('number')->whereBetween('release_date', [$from, $to])->get();
        return $results;
    }
}
