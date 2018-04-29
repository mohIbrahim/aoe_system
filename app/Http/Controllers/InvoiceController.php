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

    public function __construct(InvoiceInterface $invoice)
    {
        $this->invoice = $invoice;
        $this->middleware('auth');
        $this->middleware('invoices');
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
        $customersIdsCodes = $this->mergeCustomersCodesAndNames();
        $employeesNames = Employee::all()->pluck('user.name', 'user.name');
        return view('invoices.create', compact('indexationsCodes', 'contractsIdsCodes', 'customersIdsCodes', 'employeesNames'));
    }

    /**
     * [store description]
     * @param  InvoiceRequest $request [description]
     * @return [type]                  [description]
     */
    public function store(InvoiceRequest $request)
    {
        $invoice = $this->invoice->create($request->all());

        $isUploaded = (new ProjectImages())->receiveAndCreat($request, 'invoice_as_pdf', 'App\Invoice', $invoice->id, 'pdf', 'no_cover');
        if($request->input('type') == 'بيع قطع') {
            $pritingMachinesSerial  = $request->printing_machines_serial;
            $partsIds               = ($request->parts_ids)?($request->parts_ids):([]);
            $partsPrices            = $request->parts_prices;
            $partsSerial            = $request->parts_serial_numbers;
            $partcount              = $request->parts_count;
            $discountRate           = $request->discount_rate;
            for ($i=0; $i < count($partsIds); $i++) {
                $invoice->partsForInvoiceTypeSellPart()->attach([
                                                $partsIds[$i]=> [
                                                                    'printing_machines_serial'=>$pritingMachinesSerial,
                                                                    'price'=>$partsPrices[$i],
                                                                    'part_serial_number'=>$partsSerial[$i],
                                                                    'number_of_parts'=>$partcount[$i],
                                                                    'discount_rate'=>$discountRate[$i],
                                                                ]
                                            ]);
            }
        }

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
        return view('invoices.show', compact('invoice'));
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        $invoice = $this->invoice->getById($id);
        $indexationsCodes = Indexation::all()->pluck('code', 'id');
        $contractsIdsCodes = Contract::all()->pluck('code', 'id');
        $customersIdsCodes = $this->mergeCustomersCodesAndNames();
        $employeesNames = Employee::all()->pluck('user.name', 'user.name');
        $parts = $invoice->partsForInvoiceTypeSellPart;
        return view('invoices.edit', compact('invoice', 'indexationsCodes', 'contractsIdsCodes', 'customersIdsCodes', 'employeesNames', 'parts'));
    }

    /**
     * [update description]
     * @param  InvoiceRequest $request [description]
     * @param  [type]         $id      [description]
     * @return [type]                  [description]
     */
    public function update(InvoiceRequest $request, $id)
    {
        $invoice = $this->invoice->update($id, $request->all());

        if ($request->hasFile('invoice_as_pdf')) {
            $projectImage = new ProjectImages();
            if (isset($invoice->softCopies) && $invoice->softCopies->isNotEmpty()) {
                $projectImage->deleteOneProjectImage($invoice->softCopies->first()->id);
            }
            $isUploaded = $projectImage->receiveAndCreat($request, 'invoice_as_pdf', 'App\Invoice', $invoice->id, 'pdf', 'no_cover');
        }
        if ($request->input('type') == 'بيع قطع') {
            $invoice->partsForInvoiceTypeSellPart()->detach();
            $pritingMachinesSerial  = $request->printing_machines_serial;
            $partsIds               = ($request->parts_ids)?($request->parts_ids):([]);            
            $partsPrices            = $request->parts_prices;
            $partsSerial            = $request->parts_serial_numbers;
            $partcount              = $request->parts_count;
            $discountRate           = $request->discount_rate;
            for ($i=0; $i < count($partsIds); $i++) {
                $invoice->partsForInvoiceTypeSellPart()->attach([
                                                $partsIds[$i]=> [
                                                                    'printing_machines_serial'=>$pritingMachinesSerial,
                                                                    'price'=>$partsPrices[$i],
                                                                    'part_serial_number'=>$partsSerial[$i],
                                                                    'number_of_parts'=>$partcount[$i],
                                                                    'discount_rate'=>$discountRate[$i],
                                                                ]
                                            ]);
            }
        }

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
}
