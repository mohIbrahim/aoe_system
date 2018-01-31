<?php

namespace App\Http\Controllers;

use App\Customer;
use App\AOE\EgyptCities\EgyptCities;
use App\Http\Requests\CustomerRequest;
use App\AOE\Repositories\Customer\CustomerInterface;

class CustomerController extends Controller
{
    private $customer;


    /**
     * Instantiating Customer Repository and throttle the request with auth and customer middlewares
     * @param CustomerInterface $customer [description]
     */
    public function __construct(CustomerInterface $customer)
    {
        $this->customer = $customer;
        $this->middleware('auth');
        $this->middleware('customers');
    }


    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        $customers = $this->customer->latest()->paginate(25);
        return view('customers.index', compact('customers'));
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
        $egyptCities = (new EgyptCities())->getCities();
        $customersIdsNames = Customer::all()->pluck('name', 'id');
        return view('customers.create', compact('egyptCities', 'customersIdsNames'));
    }

    /**
     * [store description]
     * @param  CustomerRequest $request [description]
     * @return [type]                   [description]
     */
    public function store(CustomerRequest $request)
    {
        $customer = $this->customer->create($request->all());
        flash()->success(' تم إضافة عميل جديد بنجاح. ')->important();
        return redirect()->action('CustomerController@show', ['id'=>$customer->id]);
    }

    /**
     * [show description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
        $customer = $this->customer->getById($id);
        return view('customers.show', compact('customer'));
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        $customer = $this->customer->getById($id);
        $egyptCities = (new EgyptCities())->getCities();
        $customersIdsNames = Customer::all()->pluck('name', 'id');
        return view('customers.edit', compact('customer', 'egyptCities', 'customersIdsNames'));

    }

    /**
     * [update description]
     * @param  CustomerRequest $request [description]
     * @param  [type]          $id      [description]
     * @return [type]                   [description]
     */
    public function update(CustomerRequest $request, $id)
    {
        $customer = $this->customer->update($id, $request->all());
		flash()->success(' تم تعديل العميل بنجاح. ')->important();
		return redirect()->action('CustomerController@show', ['id'=>$id]);

    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        $customer = $this->customer->delete($id);
        flash()->success(' تم حذف العميل بنجاح. ')->important();
        return redirect()->action('CustomerController@index');
    }

    /**
     * [search description]
     * @param  [type] $keyword [description]
     * @return [type]          [description]
     */
    public function search($keyword)
    {
        return $this->customer->search($keyword);
    }
}
