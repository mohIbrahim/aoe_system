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
        for ($i=0; $i < count($partsIds); $i++) {
            $invoice->sellingParts()->sync([
                                            $partsIds[$i]=> [
                                                                'printing_machines_serial'=>$pritingMachinesSerial,
                                                                'price'=>$partsPrices[$i],
                                                                'part_serial_number'=>$partsSerial[$i],
                                                                'number_of_parts'=>$partcount[$i],
                                                                'discount_rate'=>$discountRate[$i],
                                                            ]
                                        ]);
        }
    }

    public function preparationInvoiceItemsForShowView(Invoice $invoice)
    {
        $results = [];
        $type = $invoice->type;
        $rowNumber = 1;
        $itemName = '';
        $itemCount = 0;
        $itemPrice = 0;
        $totalItemsPricePerRow = 0;
        $discount = 0;
        if ($type == 'تعاقد') {

            $results[] =  [
                            'rowNumber'=>$rowNumber,
                            'itemName'=>$invoice->contract->code,
                            'itemCount'=>1,
                            'itemPrice'=>$invoice->contract->price,
                            'totalItemsPricePerRow'=>$invoice->contract->price,
                            'discount'=>$invoice->contract->price,
                        ];

        } else if ($type == 'مقايسة') {
            $parts = $invoice->indexation->parts->toArray();
            // dd( $parts);
            foreach ($parts as $key=>$part) {
                $results[] =    [
                                    'rowNumber'=>$key+1,
                                    'itemName'=>$part['name'],
                                    'itemCount'=>$part['pivot']['number_of_parts'],
                                    'itemPrice'=>$part['pivot']['price'],
                                    'totalItemsPricePerRow'=>$part['pivot']['number_of_parts']*$part['pivot']['price'],
                                    'discount'=>$part['pivot']['discount_rate'],
                                ];
            }
            dd($results);

        } else if ($type == 'بيع قطع') {

        }
    }
}
// 0 => array:23 [▼
// "id" => 1533
// "code" => "DX-25FT-MA"
// "name" => "Toner -DX-25FT-MA"
// "type" => "مستهلكات"
// "descriptions" => "Magenta toner cartridge"
// "is_serialized" => 1
// "compatible_printing_machines" => "DX-2500N"
// "location_in_warehouse" => null
// "part_number" => null
// "production_date" => null
// "expiry_date" => null
// "product_number" => null
// "price_without_tax" => 1500.0
// "price_with_tax" => 0.0
// "life" => "7000"
// "qty" => 0
// "no_serial_qty" => 0
// "no_serial_date_of_entry" => null
// "no_serial_date_of_departure" => null
// "comments" => null
// "created_at" => "2018-04-23 09:15:03"
// "updated_at" => "2018-04-23 09:15:03"
// "pivot" => array:8 [▼
//   "indexation_id" => 1
//   "part_id" => 1533
//   "created_at" => "2018-04-30 14:16:51"
//   "updated_at" => "2018-04-30 14:16:51"
//   "price" => 0.0
//   "serial_number" => "202010"
//   "number_of_parts" => 2
//   "discount_rate" => 10
// ]
// ]
