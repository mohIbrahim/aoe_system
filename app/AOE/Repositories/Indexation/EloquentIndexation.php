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
        $results = $this->indexation->where('code', 'like', '%'.$keyword.'%')
                                ->orWhere('the_date', 'like', '%'.$keyword.'%')
                                ->orWhere('customer_approval', 'like', '%'.$keyword.'%')
                                ->orWhere('technical_manager_approval', 'like', '%'.$keyword.'%')
                                ->orWhere('warehouse_approval', 'like', '%'.$keyword.'%')
                                ->get();
        return $results;
    }

    public function searchFormPart($keyword)
    {
        $results = Part::where('name', 'like', '%'.$keyword.'%')
                                ->get();
        return $results;
    }

    /**
     * Auto gernerate indexation code
     */
    private function generateIndexationCode(Indexation $indexation)
    {
        if ($indexation->visit_id) {
            $printingMachineCode = \App\Visit::findOrFail($indexation->visit_id)->printingMachine->code;
            $indexation->code = $printingMachineCode.'|indexation-'.$indexation->id;
            $indexation->save();
        }
        return $indexation;
    }

}
