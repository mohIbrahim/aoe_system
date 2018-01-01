<?php
namespace App\AOE\Repositories\PrintingMachine;
use App\PrintingMachine;

class EloquentPrintingMachine implements PrintingMachineInterface
{
    private $printingMachine;

    public function __construct(PrintingMachine $model)
    {
        $this->printingMachine = $model;
    }

    public function getAll()
    {
        return $this->printingMachine->all();
    }

    public function getById($id)
    {
        return $this->prprintingMachine->findById($id);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $printingMachine = $this->model->findOrFail($id);
        $printingMachine->update($attributes);
        return $printingMachine;
    }

    public function delete($id)
    {
        $this->printingMachine->findById($id)->delete($id);
        return true;
    }

}
