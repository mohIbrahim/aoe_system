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
        $results = $this->reference->with('assignedEmployee.user', 'employeeWhoReceiveTheRereference.user', 'printingMachine')->where('code', 'like', '%'.$keyword.'%')
                                    ->orWhere('type', 'like', '%'.$keyword.'%')
                                    ->orWhere('received_date', 'like', '%'.$keyword.'%')
                                    ->orWhereHas('assignedEmployee', function($queryOne) use($keyword){
                                        $queryOne->whereHas('user', function($queryTwo) use($keyword){
                                            $queryTwo->where('name', 'like', '%'.$keyword.'%');
                                        });
                                    })
                                    ->orWhereHas('printingMachine', function($queryThree) use($keyword){
                                        $queryThree->where('code', 'like', '%'.$keyword.'%');
                                    })
                                    ->get();
        return $results;
    }

    public function referencesReportDuringWorkingDays(int $days)
    {
        $todayOfWeek = now()->addDays(0)->format('D');
        $today = now();
        $from = '';
        
        if ($todayOfWeek == 'Sun') {
            $from = now()->subDays(4);
        } else if ($todayOfWeek == 'Mon') {
            $from = now()->subDays(3);
        } else {
            $from = now()->subDays(2);
        }
        return $from;
    }

}
