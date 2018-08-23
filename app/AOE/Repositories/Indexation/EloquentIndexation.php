<?php

namespace App\AOE\Repositories\Indexation;

use App\Indexation;
use App\Part;

class EloquentIndexation implements IndexationInterface
{
    private $indexation;

    public function __construct(Indexation $indexation)
    {
        $this->indexation = $indexation;
    }
    public function getAll()
    {
        $indexations = $this->indexation->all();
        return $indexations;
    }
    public function latest()
    {
        $indexations = $this->indexation->latest();
        return $indexations;
    }
    public function oldest()
    {
        $indexations = $this->indexation->oldest();
        return $indexations;
    }
    public function getById($id)
    {
        $indexation = $this->indexation->findOrFail($id);
        return $indexation;
    }
    public function create(array $attributes)
    {
        $indexation = $this->indexation->create($attributes);
        $indexation = $this->generateIndexationCode($indexation);
        return $indexation;
    }
    public function update($id, array $attributes)
    {
        $indexation = $this->indexation->findOrFail($id);
        $indexation->update($attributes);
        $indexation = $this->generateIndexationCode($indexation);
        return $indexation;
    }
    public function delete($id)
    {
        $indexation = $this->indexation->findOrFail($id);
        $isDeleted = $indexation->delete();
        return $isDeleted;
    }

    public function search($keyword)
    {
        $results = $this->indexation->with('visit.printingMachine.customer', 'printingMachine.customer')
                                    ->where('code', 'like', '%'.$keyword.'%')
                                    ->orWhere('the_date', 'like', '%'.$keyword.'%')
                                    ->orWhere('customer_approval', 'like', '%'.$keyword.'%')
                                    ->orWhere('technical_manager_approval', 'like', '%'.$keyword.'%')
                                    ->orWhere('warehouse_approval', 'like', '%'.$keyword.'%')
                                    ->orWhere('type', 'like', '%'.$keyword.'%')
                                    ->orWhereHas('printingMachine', function($query) use($keyword){
                                        $query->where('serial_number', 'like', "%$keyword%")
                                            ->orWhereHas('customer', function($query) use($keyword){
                                            $query->where('name', 'like', '%'.$keyword.'%');
                                        });
                                    })
                                    ->orWhereHas('visit', function($query) use($keyword){
                                        $query->where('id', $keyword)
                                            ->orWhereHas('printingMachine', function($query) use($keyword){
                                                $query->where('serial_number', 'like', "%$keyword%");
                                            });
                                    })
                                    
                                    ->get();
        
        foreach($results as $indexation) {
            $indexation->totalPrice = ($indexation->statementOfRequiredParts()[1]);
        }

        return $results;
    }

    public function searchFormPart($keyword)
    {
        $results = Part::where('name', 'like', '%'.$keyword.'%')
                                ->limit(100)
                                ->get();
        return $results;
    }

    /**
     * Auto gernerate indexation code
     */
    private function generateIndexationCode(Indexation $indexation)
    {
        if (!empty($indexation->visit_id)) {
            $printingMachineCode = \App\Visit::findOrFail($indexation->visit_id)->printingMachine->code;
            $indexation->code = $printingMachineCode.'|indexation-'.$indexation->id;
            $indexation->save();
        } elseif (!empty($indexation->printing_machine_id)) {
            $printingMachineCode = $indexation->printingMachine->code;
            $indexation->code = $printingMachineCode.'|indexation-'.$indexation->id;
            $indexation->save();
        }
        return $indexation;
    }

    public function indexationsReleasedInSpecificPeriodReportSearch($from, $to)
    {
        $results = $this->indexation->with('visit')->whereBetween('the_date', [$from, $to])->get();
        return $results;
    }

}
