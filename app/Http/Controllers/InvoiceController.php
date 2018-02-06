<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\AOE\Repositories\Invoice\InvoiceInterface;
use App\Indexation;
use App\Contract;

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
        return view('invoices.create', compact('indexationsCodes', 'contractsIdsCodes'));
    }

    /**
     * [store description]
     * @param  InvoiceRequest $request [description]
     * @return [type]                  [description]
     */
    public function store(InvoiceRequest $request)
    {
        $invoice = $this->invoice->create($request->all());
        flash()->success(' تم إضافة الفاتورة بنجاح. ')->important();
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
        return view('invoices.edit', compact('invoice', 'indexationsCodes', 'contractsIdsCodes'));
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
}
