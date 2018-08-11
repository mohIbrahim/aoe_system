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

        $projectImage = new ProjectImages();
        $isUploaded = ($projectImage)->receiveAndCreat($request, 'upload_files_pdf', 'App\Contract', $contract->id, 'pdf', 'no_cover');
        $isUploaded = ($projectImage)->receiveAndCreat($request, 'upload_files_img', 'App\Contract', $contract->id, 'img', 'no_cover');

        $contract->printingMachines()->attach($request->assigned_machines_ids);
        //create invoices
        $this->contract->createInvoicesForNewContract($contract);
        
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
        $paymentsNames = $this->contract->paymentArabicNames();
        return view('contracts.show', compact('contract', 'paymentsNames'));
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
        $projectImage = new ProjectImages();
        $isUploaded = ($projectImage)->receiveAndCreat($request, 'upload_files_pdf', 'App\Contract', $contract->id, 'pdf', 'no_cover');
        $isUploaded = ($projectImage)->receiveAndCreat($request, 'upload_files_img', 'App\Contract', $contract->id, 'img', 'no_cover');

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
            $softCopiesIds = [];
            foreach($contract->softCopies as $softCopy) {
                $softCopiesIds[] = $softCopy->id;
            }
            $projectImage = new ProjectImages();
            $projectImage->deleteMultiProjectImages($softCopiesIds);
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

    public function contractsInvoicesAreDueInThisMonthReport()
    {
        $data = $this->contract->getContractsInvoicesAreDueInThisMonthReportData();
        
        $invoices       = $data[0];
        $contracts      = $data[1];
        $thisYear       = $data[2];
        $thisMonth      = $data[3];
        return view('contracts.reports.contracts_invoices_are_due_in_this_month_report', compact('invoices', 'contracts', 'thisYear', 'thisMonth'));
    }

    public function contractsThatWillExpireWithinTheNextThreeMonthesReport()
    {
        $contracts = $this->contract->getContractsThatWillExpireWithinTheNextThreeMonthes();
        return view('contracts.reports.contracts_expire_within_next_3_monthes', compact('contracts'));
    }
}
