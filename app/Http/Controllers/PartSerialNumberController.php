<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartSerialNumberRequest;
use App\PartSerialNumber;
use App\AOE\Repositories\PartSerialNumber\PartSerialNumberInterface;
use App\Part;


class PartSerialNumberController extends Controller
{
    private $partSerialNumber;


    public function __construct(PartSerialNumberInterface $partSerialNumber)
    {
        $this->partSerialNumber = $partSerialNumber;
        $this->middleware('part_serial_numbers');
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partSerialNumbers = $this->partSerialNumber->latest()->paginate(25);
        return view('part_serial_numbers.index', compact('partSerialNumbers'));
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
        $parts = Part::all()->pluck('name', 'id');
        return view('part_serial_numbers.create', compact('parts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartSerialNumberRequest $request)
    {
        $partSerialNumber = $this->partSerialNumber->create($request->all());
        flash()->success(' تم إضافة قطعة جديدة فرعية بنجاح. ')->important();
        return redirect()->action('PartSerialNumberController@show', ['id'=>$partSerialNumber->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $partSerialNumber
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $partSerialNumber = $this->partSerialNumber->getById($id);
        return view('part_serial_numbers.show', compact('partSerialNumber'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $partSerialNumber
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partSerialNumber = $this->partSerialNumber->getById($id);
        $parts = Part::all()->pluck('name', 'id');
        return view('part_serial_numbers.edit', compact('partSerialNumber', 'parts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $partSerialNumber
     * @return \Illuminate\Http\Response
     */
    public function update(PartSerialNumberRequest $request, $id)
    {
        $partSerialNumber = $this->partSerialNumber->update($id, $request->all());
        flash()->success(' تم تعديل القطعة الفرعية بنجاح. ')->important();
        return redirect()->action('PartSerialNumberController@show', ['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $partSerialNumber
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = $this->partSerialNumber->delete($id);
        flash()->success(' تم حذف القطعة الفرعية بنجاح.')->important();
        return redirect()->action('PartSerialNumberController@index');
    }

    public function search($keyword)
    {
        return $this->partSerialNumber->search($keyword);
    }
}
