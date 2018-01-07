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

	public function getAll(){
		return $this->customer->all();
	}
	public function latest(){
		return $this->customer->latest();
	}

	public function oldest(){
		return $this->customer->oldest();
	}

	public function getById($id){
		$customer = $this->customer->findOrFail($id);
		return $customer;
	}

	public function create(array $attributes){
		$customer = $this->customer->create($attributes);
		$this->addPhones($attributes['telecom'], $customer->id);
		return $customer;
	}

	public function update($id, array $attributes){
		$customer = $this->customer->findOrFail($id);
		$customer->update($attributes);
		return $customer;
	}

	public function delete($id){
		$customer = $this->customer->findOrFail($id);
		$customer->delete();
		return true;
	}


	public function addPhones(array $phonesNumbers, $customerId)
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
}
