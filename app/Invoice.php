<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = [
                            'number',
                             'type',
                              'issuer',
                               'order_number',
                                'delivery_permission_number',
                                 'finance_check_out',
                                  'release_date',
                                   'descriptions',
                                    'total',
                                     'comments',
                                      'collect_date',
                                       'collector_employee_name',
                                         'indexation_id',
                                          'contract_id',
                                           'customer_id',
                                            'creator_id',
                                             'updater_id',
                        ];

    protected $dates = ['release_date', 'collect_date'];

    public function setReleaseDateAttribute($date)
    {
        if (!empty($date)){
            $this->attributes['release_date'] = Carbon::parse($date);
        } else {
            $this->attributes['release_date'] = null;
        }
    }

    public function getReleaseDateAttribute($date)
    {
        if (!empty($date))
            return $this->asDateTime($date)->format('Y-m-d');
    }

    public function setCollectDateAttribute($date)
    {
        if (!empty($date)) {
            $this->attributes['collect_date']  = Carbon::parse($date);
        } else {
            $this->attributes['collect_date'] = null;
        }
    }

    public function getCollectDateAttribute($date)
    {
        if (!empty($date)) {
            return $this->asDateTime($date)->format('Y-m-d');
        }
    }

    public function setFinanceCheckOutAttribute($data)
    {
        if(!isset($data))
        $this->attributes['finance_check_out'] = 'لم يتم الاطلاع';
        else
        $this->attributes['finance_check_out'] = $data;
    }

    public function getSelectedResponsibleEmpsIdsForInvoiceAttribute()
    {
        return ($this->employeesResponisableForThisInvoice->isNotEmpty())?($this->employeesResponisableForThisInvoice->pluck('id')->toArray()):([]);
    }
    
    public function getEmployeesNamesThatAreResponsibleOnThisInvoiceAttribute()
    {
        $employees = ($this->employeesResponisableForThisInvoice->isNotEmpty())?($this->employeesResponisableForThisInvoice):([]);
        $employeesNames = '';
        foreach($employees as $employee) {
            $employeesNames .= $employee->employeeName . ' &nbsp; &nbsp;';
        }
        return $employeesNames;

    }

    public function indexation()
    {
        return $this->belongsTo('App\Indexation', 'indexation_id');
    }

    public function contract()
    {
        return $this->belongsTo('App\Contract', 'contract_id', 'id');
    }

    public function softCopies()
    {
        return $this->morphMany('App\ProjectImages', 'imageable');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }

    public function sellingParts()
    {
        return $this->belongsToMany('App\Part', 'invoice_part', 'invoice_id', 'part_id')
                    ->withPivot(['printing_machines_serial', 'part_description', 'price', 'price_without_tax', 'part_serial_number', 'number_of_parts', 'discount_rate'])
                    ->withTimestamps();
    }

    public function employeesResponisableForThisInvoice()
    {
        return $this->belongsToMany('App\Employee', 'employee_invoice_responsibilities', 'invoice_id', 'employee_id');
    }

    public function userWhoHasCreatedTheInvoice()
    {
        return $this->belongsTo('App\User', 'creator_id', 'id');
    }

    public function userWhoHasUpdateTheInvoice()
    {
        return $this->belongsTo('App\User', 'updater_id', 'id');
    }

     //this for show view
     // Invoice type parts
     public function statementOfRequiredParts(Invoice $invoice)
     {
         $parts = $invoice->sellingParts;
         $statement  = [];
         $row        = [];
         
         $totalPriceWithTax = 0;
         $totalPriceWithoutTax = 0;
         $totalTax = 0;
         $totalDiscountOnParts = 0;

         $printingMachinesSerial ='';

         foreach ($parts as $part) {
             $id                                 = $part->id;
             $name                               = $part->name;
             $descriptions                       = $part->pivot->part_description;
             $serialNumber                       = $part->pivot->part_serial_number;
             $partPriceWithoutTax                = $part->pivot->price_without_tax;
             $partPriceWithTax                   = $part->pivot->price;
             $numberOfParts                      = $part->pivot->number_of_parts;
             
             $discountRate                       = $part->pivot->discount_rate;
             $discountOnPart                     = (($partPriceWithoutTax * $discountRate) / 100);
             $partPriceWithoutTaxWithDiscount    = $partPriceWithoutTax - (($partPriceWithoutTax * $discountRate) / 100);
             
             $tax                                = $partPriceWithTax - $partPriceWithoutTax;
             $taxPercentage                      = round(((($partPriceWithTax - $partPriceWithoutTax)  * 100 ) / (($partPriceWithoutTax > 0)?($partPriceWithoutTax):(1))), 2);
             
             $rowPriceWithTax                    = (($partPriceWithoutTaxWithDiscount) + $tax) * $numberOfParts;
             $rowPriceWithoutTax                 = $partPriceWithoutTaxWithDiscount * $numberOfParts;

             $printingMachinesSerial             = $part->pivot->printing_machines_serial;
 
             $row =  [
                         'id'                       =>$id, 
                         'name'                     =>$name, 
                         'descriptions'             =>$descriptions, 
                         'serialNumber'             =>$serialNumber, 
                         'numberOfParts'            =>$numberOfParts, 
                         'partPriceWithTax'         =>$partPriceWithTax, 
                         'partPriceWithoutTax'      =>$partPriceWithoutTax, 
                         'discountRate'             =>$discountRate,
                         'taxPercentage'            =>$taxPercentage, 
                         'discountOnPart'           =>$discountOnPart, 
                         'rowPriceWithTax'          =>$rowPriceWithTax,
                         'rowPriceWithoutTax'       =>$rowPriceWithoutTax,
                         'printingMachinesSerial'   =>$printingMachinesSerial,
                     ];
 
             $statement[]            = $row;
             $totalPriceWithTax      += $rowPriceWithTax;
             $totalPriceWithoutTax   += $rowPriceWithoutTax;
             $totalTax               += $tax;
             $totalDiscountOnParts   += $discountOnPart;
         }
         return [$statement, $totalPriceWithTax, $totalPriceWithoutTax, $totalTax, $totalDiscountOnParts];
     }
}
