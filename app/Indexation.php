<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indexation extends Model
{
    protected $table = 'indexations';
    protected $fillable =   [
                                'code',
                                'type',
                                'the_date',
                                'customer_approval',
                                'technical_manager_approval',
                                'warehouse_approval',
                                'comments',
                                'visit_id',
                                'printing_machine_id',
                                'performed_employee_id',
                            ];

    protected $dates = ['the_date'];

    public function setTheDateAttribute($date)
    {
        if (!empty($date)) {
            $this->attributes['the_date'] = $this->asDateTime($date);
        } else {
            $this->attributes['the_date'] = null;
        }
    }

    public function getTheDateAttribute($date)
    {
        if (!empty($date)) {
            return $this->asDateTime($date)->format('Y-m-d');
        }
    }

    public function setCustomerApprovalAttribute($data)
    {
        if (!isset($data)) {
            $this->attributes['customer_approval'] = 'ليس بعد';
        } else {
            $this->attributes['customer_approval'] = $data;
        }
    }

    public function setTechnicalManagerApprovalAttribute($data)
    {
        if (!isset($data)) {
            $this->attributes['technical_manager_approval'] = 'ليس بعد';
        } else {
            $this->attributes['technical_manager_approval'] = $data;
        }
    }

    public function setWarehouseApprovalAttribute($data)
    {
        if (!isset($data)) {
            $this->attributes['warehouse_approval'] = 'ليس بعد';
        } else {
            $this->attributes['warehouse_approval'] = $data;
        }
    }

    public function visit()
    {
        return $this->belongsTo('App\Visit', 'visit_id');
    }

    public function invoice()
    {
        return $this->hasOne('App\Invoice', 'indexation_id');
    }

    public function softCopies()
    {
        return $this->morphMany('App\ProjectImages', 'imageable');
    }

    public function parts()
    {
        return $this->belongsToMany('App\Part', 'indexation_part')->withTimestamps()->withPivot('price_without_tax', 'price', 'serial_number', 'number_of_parts', 'discount_rate', 'part_description');
    }
    //when the indexation done by telephone
    public function printingMachine()
    {
        return $this->belongsTo('App\PrintingMachine', 'printing_machine_id', 'id');
    }

    public function employeeWhoPerformedTheIndexation()
    {
        return $this->belongsTo(Employee::class, 'performed_employee_id', 'id');
    }

    /**
     * Getting the Employee name that take the indexation
     */
    public function employeeNameWhoPerformedTheIndexation()
    {
        try{
            return $this->employeeWhoPerformedTheIndexation->user->name;
        }catch(\Exception $e){
            return 'لم يتم تحديد المهندس بعد';
        }
    }

    
    //this for show view
    public function statementOfRequiredParts(Indexation $indexation)
    {
        $parts = $indexation->parts;
        $statement  = [];
        $row        = [];
        $totalPriceWithTax = 0;
        $totalPriceWithoutTax = 0;
        $totalTax = 0;
        $totalDiscountOnParts = 0;
        foreach ($parts as $part) {
            $id                                 = $part->id;
            $name                               = $part->name;
            $descriptions                       = $part->pivot->part_description;
            $serialNumber                       = $part->pivot->serial_number;
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

            $row =  [
                        'id'                    =>$id, 
                        'name'                  =>$name, 
                        'descriptions'          =>$descriptions, 
                        'serialNumber'          =>$serialNumber, 
                        'numberOfParts'         =>$numberOfParts, 
                        'partPriceWithTax'      =>$partPriceWithTax, 
                        'partPriceWithoutTax'   =>$partPriceWithoutTax, 
                        'discountRate'          =>$discountRate,
                        'taxPercentage'         =>$taxPercentage, 
                        'discountOnPart'        =>$discountOnPart, 
                        'rowPriceWithTax'       =>$rowPriceWithTax,
                        'rowPriceWithoutTax'    =>$rowPriceWithoutTax,
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
