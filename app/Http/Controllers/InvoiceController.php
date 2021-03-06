<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\AOE\Repositories\Invoice\InvoiceInterface;
use App\Indexation;
use App\Contract;
use App\ProjectImages;
use App\Customer;
use App\Employee;

class InvoiceController extends Controller
{

    private $invoice;
    private $authenticatedUser;

    public function __construct(InvoiceInterface $invoice)
    {
        $this->invoice = $invoice;
        $this->middleware('auth');
        $this->middleware('invoices');
        $this->middleware(function( $request, $next){
            $this->authenticatedUser = $request->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = $this->invoice->latest()->paginate(25);
        return view('invoices.index', compact('invoices'));
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
        $indexationsCodes = Indexation::all()->pluck('code', 'id');
        $contractsIdsCodes = Contract::all()->pluck('code', 'id');
        $employeesNames = Employee::all()->pluck('user.name', 'user.name');
        $employeesNamesIds = Employee::all()->pluck('user.name', 'id');
        return view('invoices.create', compact('indexationsCodes', 'contractsIdsCodes', 'employeesNames', 'employeesNamesIds'));
    }

    /**
     * [store description]
     * @param  InvoiceRequest $request [description]
     * @return [type]                  [description]
     */
    public function store(InvoiceRequest $request)
    {
        $invoice = $this->invoice->create(array_merge($request->all(), ['creator_id'=>$this->authenticatedUser->id]));

        $isUploaded = (new ProjectImages())->receiveAndCreat($request, 'invoice_as_pdf', 'App\Invoice', $invoice->id, 'pdf', 'no_cover');

        if($request->input('type') == 'بيع قطع') {
            $this->invoice->attachSellingParts($request, $invoice);
        }

        $invoice->employeesResponisableForThisInvoice()->sync($request->input('emps_ids_reponsible_for_invoice'));
        
        flash()->success(' تم إنشاء الفاتورة بنجاح. ')->important();
        return redirect()->action('InvoiceController@show', ['id'=>$invoice->id]);
    }

    /**
     * [show description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
        $invoice = $this->invoice->getById($id);
        if ( $invoice->type == 'مقايسة' ) {
            $statement = $this->invoice->preparationInvoiceItemsForShowView($invoice);
            $statementOfRequiredParts = $statement[0];
            $totalPriceWithTax = $statement[1];
            $totalPriceWithoutTax = $statement[2];
            $totalTax = $statement[3];
            return view('invoices.show', compact('invoice', 'statementOfRequiredParts', 'totalPriceWithTax', 'totalPriceWithoutTax', 'totalTax'));
        } elseif ( $invoice->type == 'بيع قطع' ) {
            $statement = $this->invoice->preparationInvoiceItemsForShowView($invoice);
            $statementOfRequiredParts = $statement[0];
            $totalPriceWithTax = $statement[1];
            $totalPriceWithoutTax = $statement[2];
            $totalTax = $statement[3];
            return view('invoices.show', compact('invoice', 'statementOfRequiredParts', 'totalPriceWithTax', 'totalPriceWithoutTax', 'totalTax'));
        } elseif ( $invoice->type == 'تعاقد' ) {
            $results = $this->invoice->preparationInvoiceItemsForShowView($invoice);
            $statements = $results[0];
            return view('invoices.show', compact('invoice', 'statements'));
        }
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        $invoice = $this->invoice->getById($id);
        // dd($invoice->selectedResponsibleEmpsIdsForInvoice);
        $indexationsCodes = Indexation::all()->pluck('code', 'id');
        $contractsIdsCodes = Contract::all()->pluck('code', 'id');
        $employeesNames = Employee::all()->pluck('user.name', 'user.name');
        $employeesNamesIds = Employee::all()->pluck('user.name', 'id');
        $parts = $invoice->sellingParts;
        return view('invoices.edit', compact('invoice', 'indexationsCodes', 'contractsIdsCodes', 'employeesNames', 'parts', 'employeesNamesIds'));
    }

    /**
     * [update description]
     * @param  InvoiceRequest $request [description]
     * @param  [type]         $id      [description]
     * @return [type]                  [description]
     */
    public function update(InvoiceRequest $request, $id)
    {
        $invoice = $this->invoice->update($id, array_merge($request->all(), ['updater_id'=>$this->authenticatedUser->id]));

        if ($request->hasFile('invoice_as_pdf')) {
            $projectImage = new ProjectImages();
            if (isset($invoice->softCopies) && $invoice->softCopies->isNotEmpty()) {
                $projectImage->deleteOneProjectImage($invoice->softCopies->first()->id);
            }
            $isUploaded = $projectImage->receiveAndCreat($request, 'invoice_as_pdf', 'App\Invoice', $invoice->id, 'pdf', 'no_cover');
        }

        if($request->input('type') == 'بيع قطع') {
            $this->invoice->attachSellingParts($request, $invoice);
        }else {
            $invoice->sellingParts()->detach();
        }

        $invoice->employeesResponisableForThisInvoice()->sync($request->input('emps_ids_reponsible_for_invoice'));

        flash()->success(' تم تعديل الفاتورة بنجاح. ')->important();
        return redirect()->action('InvoiceController@show', ['id'=>$id]);
    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        $invoice = $this->invoice->getById($id);
        if (isset($invoice->softCopies) && $invoice->softCopies->isNotEmpty()) {
            $projectImage = new ProjectImages();
            $projectImage->deleteOneProjectImage($invoice->softCopies->first()->id);
        }
        $isDeleted = $this->invoice->delete($id);
        flash()->success(' تم حذف الفاتورة بنجاح. ')->important();
        return redirect()->action('InvoiceController@index');
    }
    /**
     * [search description]
     * @param  [type] $keyword [description]
     * @return [type]          [description]
     */
    public function search($keyword)
    {
        return $this->invoice->search($keyword);
    }

    public function removeInvoiceFile($projectImageId)
    {
        $isUploaded = (new ProjectImages())->deleteOneProjectImage($projectImageId);
        return back()->withInput();
    }

    public function mergeCustomersCodesAndNames()
    {
        $mergedArray = array();
        $customers = $customerIdsCodes = Customer::all();
        foreach ($customers as $key => $customer ) {
            $mergedArray[$customer->id] = $customer->code.'('.$customer->name.')'; 
        }
        return $mergedArray;

    }

    public function invoiceFormPartSearch($keyword)
    {
        return $this->invoice->searchFormPart($keyword);
    }

    public function invoiceFormCustomerSearch($keyword)
    {
        return $this->invoice->invoiceFormCustomerSearch($keyword);
    }
    
    public function createWithCustomerId($customerId)
    {
        $invoice = (object)['customer'=>(Customer::findOrFail($customerId))];
        $indexationsCodes = Indexation::all()->pluck('code', 'id');
        $contractsIdsCodes = Contract::all()->pluck('code', 'id');
        $employeesNames = Employee::all()->pluck('user.name', 'user.name');
        $employeesNamesIds = Employee::all()->pluck('user.name', 'id');
        return view('invoices.create', compact('invoice', 'indexationsCodes', 'contractsIdsCodes', 'employeesNames', 'employeesNamesIds'));
    }

    public function createWithCustomerIdAndIndexationId($customerId, $indexationId)
    {
        $invoice = (object)['customer'=>(Customer::findOrFail($customerId))];
        $invoice->type = 'مقايسة';
        $invoice->indexation_id = $indexationId;
        
        $indexationsCodes = Indexation::all()->pluck('code', 'id');
        $contractsIdsCodes = Contract::all()->pluck('code', 'id');
        $employeesNames = Employee::all()->pluck('user.name', 'user.name');
        $employeesNamesIds = Employee::all()->pluck('user.name', 'id');
        return view('invoices.create', compact('invoice', 'indexationsCodes', 'contractsIdsCodes', 'employeesNames', 'employeesNamesIds'));
    }

    public function getInvoicesReleasedInSpecificPeriodReport()
    {
        return view('invoices.reports.invoices_released_in_specific_period_report');
    }
    
    public function invoicesReleasedInSpecificPeriodReportSearch($from, $to)
    {
        $results = $this->invoice->invoicesReleasedInSpecificPeriodReportSearch($from, $to);
        return $results;
    }
    /**
     * Getting  all invoices as excel sheet.
     *
     * @return void
     */
    public function getAllInvoicesAsExcel()
    {
        return $this->invoice->getAllInvoicesAsExcel();
    }
}
