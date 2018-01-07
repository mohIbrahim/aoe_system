<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\AOE\EgyptCities\EgyptCities;
use App\Http\Requests\CustomerRequest;
use App\AOE\Repositories\Customer\CustomerInterface;

class CustomerController extends Controller
{
    private $customer;



    public function __construct(CustomerInterface $customer)
    {
        $this->customer = $customer;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $egyptCities = (new EgyptCities())->getCities();
        return view('customers.create', compact('egyptCities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $customer = $this->customer->create($request->all());
        flash()->success(' تم إضافة عميل جديد بنجاح. ')->important();
        return redirect()->action('CustomerController@show', ['id'=>$customer->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = $this->customer->getById($id);
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = $this->customer->getById($id);
        $egyptCities = (new EgyptCities())->getCities();
        return view('customers.edit', compact('customer', 'egyptCities'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }


    public function search($keyword)
    {
        # code...
    }
}
