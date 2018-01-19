<?php

namespace App\AOE\Repositories\ReadingOfPrintingMachine;

use App\ReadingOfPrintingMachine;

class EloquentReadingOfPrintingMachine implements ReadingOfPrintingMachineInterface
{
    private $read;


    public function __construct(ReadingOfPrintingMachine $model)
    {
        $this->read =  $model;
    }

    public function getAll()
    {
        $reads = $this->read->all();
        return $reads;
    }


    public function getById($id)
    {
        $read = $this->read->findOrFail($id);
        return $read;
    }


    public function latest($id)
    {
        $read = $this->read->latest();
        return $read;
    }

    public function oldest($id)
    {
        $read = $this->read->oldest();
        return $read;
    }


    public function create(array $attributes)
    {
        $read = $this->read->create($attributes);
        return $read;
    }


    public function update($id, array $attributes)
    {
        $read = $this->read->findOrFail($id);
        $isUpdated = $read->update($attributes);
        return $isUpdatd;
    }


    public function delete($id)
    {
        $read = $this->read->findOrFail($id);
        $isDeleted = $read->delete();
        return $isDeleted;
    }


}
