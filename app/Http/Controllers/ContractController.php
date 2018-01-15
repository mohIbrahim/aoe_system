<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContractRequest;
use App\AOE\Repositories\Contract\ContractInterface;

class ContractController extends Controller
{
    private $contract;

    public function __construct(ContractInterface $contract)
    {
        $this->contract = $contract;
        $this->middleware('auth');
        $this->middleware('contracts');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = $this->contract->latest()->paginate(25);
        return view('contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contracts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractRequest $request)
    {
        $contract = $this->contract->create($request->all());
        flash()->success('تم إضافة العقد بنجاح. ')->important();
        return redirect()->action('ContractController@show', ['id'=>$contract->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Part  $contract
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contract = $this->contract->getById($id);
        return view('contracts.show', compact('contract'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Part  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract = $this->contract->getById($id);
        return view('contracts.edit', compact('contract'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Part  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(ContractRequest $request, $id)
    {
        $contract = $this->contract->update($id, $request->all());
        flash()->success('تم تعديل العقد بنجاح. ')->important();
        return redirect()->action('ContractController@show', ['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Part  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = $this->contract->delete($id);
        flash()->success('تم حذف العقد بنجاح. ')->important();
        return redirect()->action('ContractController@index');
    }

    public function search($keyword)
    {
        return $this->contract->search($keyword);
    }
}
