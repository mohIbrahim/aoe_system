<?php

namespace App\Http\Controllers;

use App\PrintingMachine;
use Illuminate\Http\Request;
use App\AOE\Repositories\PrintingMachine\PrintingMachineInterface;
use App\Http\Requests\PrintingMachineRequest;

class PrintingMachineController extends Controller
{
    private $printingMachine;

    public function __construct(PrintingMachineInterface $printingMachine)
    {
        $this->printingMachine = $printingMachine;
		$this->middleware('auth');
		$this->middleware('printing_machines');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$printingMachines = $this->printingMachine->latest()->paginate(1);
		return view('printing_machines.index', compact('printingMachines'));
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
    public function store(PrintingMachineRequest $request)
    {
		$printingMachine = $this->printingMachine->create($request->all());
		flash()->success('تم إضافة آلة جديدة بنجاح.')->important();
		return redirect()->action('PrintingMachineController@show', ['id'=>$printingMachine->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PrintingMachine  $printingMachine
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$printingMachine = $this->printingMachine->getById($id);
		return view('printing_machines.show', compact("printingMachine"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PrintingMachine  $printingMachine
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$printingMachine = $this->printingMachine->getById($id);
		return view('printing_machines.edit', compact('printingMachine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PrintingMachine  $printingMachine
     * @return \Illuminate\Http\Response
     */
    public function update(PrintingMachineRequest $request, $id)
    {
        $printingMachine = $this->printingMachine->update($id, $request->all());
		flash()->success(' تم تعديل الآلة بنجاح. ')->important();
		return redirect()->action('PrintingMachineController@show', ['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PrintingMachine  $printingMachine
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$this->printingMachine->delete($id);
		flash()->success(' تم حذف الآلة بنجاح. ')->important();
		return redirect()->action('PrintingMachineController@index');
    }


    public function search($keyword)
    {
        return $this->printingMachine->search($keyword);
    }
}
