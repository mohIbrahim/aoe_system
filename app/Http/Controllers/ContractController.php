<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContractRequest;
use App\AOE\Repositories\Contract\ContractInterface;
use App\PrintingMachine;
use App\ProjectImages;
use App\Employee;
use \App\AOE\Repositories\PrintingMachine\EloquentPrintingMachine;

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
        $employeesIdsNames = Employee::all()->pluck('user.name', 'id');
        return view('contracts.create', compact('employeesIdsNames'));
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

        $isUploaded = (new ProjectImages())->receiveAndCreat($request, 'contract_as_pdf', 'App\Contract', $contract->id, 'pdf', 'no_cover');

        $contract->printingMachines()->attach($request->assigned_machines_ids);
        
        flash()->success('تم إنشاء العقد بنجاح. ')->important();
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
        $paymentsNamesAndDates = $this->contract->paymentsIsDueNamesAndDates($contract);
        $paymentsNames = $paymentsNamesAndDates[0];
        $paymentsDates = $paymentsNamesAndDates[1];
        return view('contracts.show', compact('contract', 'paymentsNames', 'paymentsDates'));
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
        $employeesIdsNames = Employee::all()->pluck('user.name', 'id');
        return view('contracts.edit', compact('contract', 'employeesIdsNames'));
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

        //upload file
        if ($request->hasFile('contract_as_pdf')) {
            $projectImage = new ProjectImages();
            if (isset($contract->softCopies) && $contract->softCopies->isNotEmpty()) {
                $projectImage->deleteOneProjectImage($contract->softCopies->first()->id);
            }
            $isUploaded = $projectImage->receiveAndCreat($request, 'contract_as_pdf', 'App\Contract', $contract->id, 'pdf', 'no_cover');
        }

		$contract->printingMachines()->sync($request->assigned_machines_ids);        
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
        $contract = $this->contract->getById($id);
        if (isset($contract->softCopies) && $contract->softCopies->isNotEmpty()) {
            $projectImage = new ProjectImages();
            $projectImage->deleteOneProjectImage($contract->softCopies->first()->id);
        }
        $isDeleted = $this->contract->delete($id);
        flash()->success('تم حذف العقد بنجاح. ')->important();
        return redirect()->action('ContractController@index');
    }

    public function search($keyword)
    {
        return $this->contract->search($keyword);
    }

    public function removeContractFile($projectImageId)
    {
        $isUploaded = (new ProjectImages())->deleteOneProjectImage($projectImageId);
        return back()->withInput();
    }
	/**
	*	Searching for printing machine by customer name that ajax request from contract _form
	*
	**/
    public function searchingOnPrintingMachinesByCustomerName($keyword)
    {
        $eloquentPrintingMachine = new EloquentPrintingMachine(new PrintingMachine());
        return $eloquentPrintingMachine->searchingOnPrintingMachinesByCustomerName($keyword);
    }
	/**
	*	Create contract from priting machine show view by passing printing machine id
	* 	to make easy for system users to create that contract
	*
	**/
	public function createWithPrintingMachineId($printingMachineId)
    {
        $employeesIdsNames = Employee::all()->pluck('user.name', 'id');
        $pMachine = PrintingMachine::findOrFail($printingMachineId);
        return view('contracts.create', compact('employeesIdsNames', 'pMachine'));
    }

    public function paymentsIsDueInThisMonthReport()
    {
        $paymentsNamesDatesContract = $this->contract->getPaymentsIsDueInThisMonth();
        $paymentsNames = $paymentsNamesDatesContract[0];
        $paymentsDates = $paymentsNamesDatesContract[1];
        $contracts = $paymentsNamesDatesContract[2];
        $thisYear = $paymentsNamesDatesContract[3];
        $thisMonth = $paymentsNamesDatesContract[4];
        return view('contracts.reports.payments_is_due_in_this_month', compact('paymentsNames', 'paymentsDates', 'contracts', 'thisYear', 'thisMonth'));
    }
}
