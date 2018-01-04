<?php
namespace App\AOE\Repositories;
use App\AOE\Repositories\Customer;

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
}
