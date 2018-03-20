<?php

namespace App\AOE\Repositories\Reference;

use App\Reference;

class EloquentReference implements ReferenceInterface
{
    private $reference;

    public function __construct(Reference $reference)
    {
        $this->reference = $reference;
    }
    public function getAll()
    {
        $references = $this->reference->all();
        return $references;
    }
    public function latest()
    {
        $references = $this->reference->latest();
        return $references;
    }
    public function oldest()
    {
        $references = $this->reference->oldest();
        return $references;
    }
    public function getById($id)
    {
        $reference = $this->reference->findOrFail($id);
        return $reference;
    }
    public function create(array $attributes)
    {
        $reference = $this->reference->create($attributes);
        return $reference;
    }
    public function update($id, array $attributes)
    {
        $reference = $this->reference->findOrFail($id);
        $reference->update($attributes);
        return $reference;
    }
    public function delete($id)
    {
        $reference = $this->reference->findOrFail($id);
        $isDeleted = $reference->delete();
        return $isDeleted;
    }

    public function search($keyword)
    {
        $results = $this->reference->with('assignedEmployee.user', 'employeeWhoReceiveTheRereference.user', 'printingMachine', 'printingMachine.customer')->where('code', 'like', '%'.$keyword.'%')
                                    ->orWhere('type', 'like', '%'.$keyword.'%')
                                    ->orWhere('received_date', 'like', '%'.$keyword.'%')
                                    ->orWhereHas('assignedEmployee', function($queryOne) use($keyword){
                                        $queryOne->whereHas('user', function($queryTwo) use($keyword){
                                            $queryTwo->where('name', 'like', '%'.$keyword.'%');
                                        });
                                    })
                                    ->orWhereHas('printingMachine', function($queryThree) use($keyword){
                                        $queryThree->where('code', 'like', '%'.$keyword.'%')
                                                    ->orWhere('serial_number', 'like', '%'.$keyword.'%');
                                    })
                                    ->orWhereHas('printingMachine', function($queryFour) use($keyword){
                                        $queryFour->whereHas('customer', function($queryFive) use($keyword){
                                            $queryFive->where('name', 'like', '%'.$keyword.'%');
                                        });
                                    })
                                    ->get();
        return $results;
    }

    public function referencesReportDuringLastTwoWorkingDays()
    {
        $todayOfWeek = now()->subDays(0)->format('D');
        $today = now()->toDateString();
        $from = '';
        
        if ($todayOfWeek == 'Sun') {
            $from = now()->subDays(4)->toDateString();
        } else if ($todayOfWeek == 'Mon') {
            $from = now()->subDays(3)->toDateString();
        } else {
            $from = now()->subDays(2)->toDateString();
        }
        $results = $this->reference->whereBetween('received_date', [$from, $today]);
        return $results;
    }

}
