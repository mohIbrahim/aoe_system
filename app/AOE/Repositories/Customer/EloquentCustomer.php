<?php
namespace App\AOE\Repositories\Customer;
use App\Customer;
use App\Telecom;
class EloquentCustomer implements CustomerInterface
{

	private $customer;

	public function __construct(Customer $model)
	{
		$this->customer = $model;
	}

	public function getAll()
	{
		return $this->customer->all();
	}
	public function latest()
	{
		return $this->customer->latest();
	}

	public function oldest()
	{
		return $this->customer->oldest();
	}

	public function getById($id)
	{
		$customer = $this->customer->findOrFail($id);
		return $customer;
	}

	public function create(array $attributes)
	{
		//remove telecom item form attributes array we had error in seeding warrantyseeder import excel file.
		$phonesNumbers = $attributes['telecom'];
		unset($attributes['telecom']);

		$customer = $this->customer->create($attributes);
		$code = $this->setCustomCode($attributes, $customer);
		$customer->code = $code;
		$customer->save();		
		$this->addPhones($phonesNumbers, $customer->id);
		return $customer;
	}

	public function update($id, array $attributes)
	{
		$customer = $this->customer->findOrFail($id);
		$attributes['code'] = $this->setCustomCode($attributes, $customer);		
		$customer->update($attributes);
		$this->updatePhones($customer, $attributes['telecom']);
		$this->updateCustomerPrintingMachinesCode($customer);
		return $customer;
	}

	public function delete($id)
	{
		$customer = $this->customer->findOrFail($id);
		$customer->delete();
		return true;
	}


	private function addPhones(array $phonesNumbers, $customerId)
	{
		if(!empty($phonesNumbers)){

			foreach ($phonesNumbers as $number) {
				if(isset($number)){
					$telecom = Telecom::create(['telecomable_id'=>$customerId, 'telecomable_type'=>'App\Customer', 'number'=>$number, 'type'=>null]);
				}
			}

			return true;
		}
		return false;
	}


	private function updatePhones(Customer $customer, array $numbers)
	{
		$telecoms = $customer->telecoms();
		foreach ($telecoms->get() as $telecom) {
			$telecom->delete();
		}
        $this->addPhones($numbers, $customer->id);
	}

    public function search($keyword)
    {
        $results = $this->customer->with('telecoms')->where('name', 'like', "%$keyword%")
                                    ->orWhere('code', 'like', "%$keyword%")
                                    ->get();
        return $results;
	}
	
	private function setCustomCode(array $attributes, Customer $customer)
	{
		$sector = ($attributes['sector'] == 'قطاع حكومي')?('Gov'):('Pri');
		$type = '';
		if( $customer->type == 'أفراد') {
			$type = 'Ind';
		} else if ($customer->type == 'شركات') {
			$type = 'Cor';
		} else if ($customer->type == 'وزارات') {
			$type = 'Minis';
		} else if ($customer->type == 'مدارس') {
			$type = 'Sc';
		} else if ($customer->type == 'مستشفيات') {
			$type = 'Hl';
		} else if ($customer->type == 'بنوك') {
			$type = 'Bn';		
		} else if ($customer->type == 'مؤسسة') {
			$type = 'Inst';
		}
		$code = $sector.'-'.$type.'-'.$customer->id;
		return $code;
	}

	private function updateCustomerPrintingMachinesCode(Customer $customer)
	{
		$printingMachins = $customer->printingMachines;
		if ($printingMachins->isNotEmpty()) {
			foreach ($printingMachins as $printingMachine) {
				$printingMachine->code = $customer->code.'-'.$printingMachine->id;
				$printingMachine->save();
			}
		}
	}

	public function getCountOfMainBraches()
	{
		return $count = Customer::whereNull('main_branch_id')->count();
	}
}
