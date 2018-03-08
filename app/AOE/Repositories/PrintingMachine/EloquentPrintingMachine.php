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

    public function search($keyword)
    {
        $results = $this->printingMachine->with('customer')->where('folder_number', 'like', "%$keyword%")
                            ->orWhere('code', 'like', "%$keyword%")
                            ->orWhere('model_prefix', 'like', "%$keyword%")
                            ->orWhere('model_suffix', 'like', "%$keyword%")
                            ->orWhereHas('customer', function($query) use($keyword){
                                $query->where('name', 'like', '%'.$keyword.'%');
                            })
                            ->get();
        return $results;
    }

    public function searchLimitedCodeCustomer($keyword)
    {
        $results = $this->printingMachine->with('customer', 'assignedEmployees.user')
							->where('code', 'like', "%$keyword%")
                            ->orWhereHas('customer', function($query) use($keyword){
                                $query->where('name', 'like', '%'.$keyword.'%');
                            })
                            ->limit(50)
                            ->get();
        return $results;
    }

	public function searchingOnPrintingMachinesByCustomerName($keyword)
    {
        $results = $this->printingMachine->with('customer')
                            ->orWhereHas('customer', function($query) use($keyword){
                                $query->where('name', 'like', '%'.$keyword.'%');
                            })
                            ->limit(50)
                            ->get();
        return $results;
    }

}
