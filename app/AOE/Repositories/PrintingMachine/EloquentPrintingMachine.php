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

	public function latest()
	{
		return $this->printingMachine->latest();
	}

	public function oldest()
	{
		return $this->printingMachine->oldest();
	}

    public function getById($id)
    {
        return $this->printingMachine->findOrFail($id);
    }

    public function create(array $attributes)
    {
        return $this->printingMachine->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $printingMachine = $this->printingMachine->findOrFail($id);
        $printingMachine->update($attributes);
        return $printingMachine;
    }

    public function delete($id)
    {
        $this->printingMachine->findOrFail($id)->delete($id);
        return true;
    }

}
