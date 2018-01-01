<?php

namespace App\Http\Controllers;

use App\PrintingMachine;
use Illuminate\Http\Request;
use App\AOE\Repositories\PrintingMachine\PrintingMachineInterface;
use App\Http\Requests\PrinterMachineRequest;

class PrintingMachineController extends Controller
{
    private $printingMachine;

    public function __construct(PrintingMachineInterface $printingMachine)
    {
        $this->printingMachine = $printingMachine;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->printingMachine->getAll();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('printing_machines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrinterMachineRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PrintingMachine  $printingMachine
     * @return \Illuminate\Http\Response
     */
    public function show(PrintingMachine $printingMachine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PrintingMachine  $printingMachine
     * @return \Illuminate\Http\Response
     */
    public function edit(PrintingMachine $printingMachine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PrintingMachine  $printingMachine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PrintingMachine $printingMachine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PrintingMachine  $printingMachine
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrintingMachine $printingMachine)
    {
        //
    }
}
