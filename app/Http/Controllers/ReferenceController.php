<?php

namespace App\Http\Controllers;

use App\AOE\Repositories\Reference\ReferenceInterface;
use App\Http\Requests\ReferenceRequest;
use App\Employee;


class ReferenceController extends Controller
{
    private $reference;

    public function __construct(ReferenceInterface $reference)
    {
        $this->reference = $reference;
        $this->middleware('auth');
        $this->middleware('references');
    }

    public function index()
    {
        $references = $this->reference->latest()->paginate(25);
        return view('references.index', compact('references'));
    }


    public function create()
    {
        $employeesNames = Employee::all()->pluck('user.name', 'id');
        return view('references.create', compact('employeesNames'));
    }


    public function store(ReferenceRequest $request)
    {
        $reference = $this->reference->create($request->all());
        flash()->success(' تم إضافة الإشارة بنجاح. ')->important();
        return redirect()->action('ReferenceController@show', ['id'=>$reference->id]);
    }


    public function show($id)
    {
        $reference = $this->reference->getById($id);
        return view('references.show', compact('reference'));
    }


    public function edit($id)
    {
        $reference = $this->reference->getById($id);
        $employeesNames = Employee::all()->pluck('user.name', 'id');
        return view('references.edit', compact('reference', 'employeesNames'));
    }


    public function update(ReferenceRequest $request, $id)
    {
        $reference = $this->reference->update($id, $request->all());
        flash()->success(' تم تعديل الإشارة بنجاح. ')->important();
        return redirect()->action('ReferenceController@show', ['id'=>$id]);
    }


    public function destroy($id)
    {
        $isDeleted = $this->reference->delete($id);
        flash()->success(' تم حذف الإشارة بنجاح. ')->important();
        return redirect()->action('ReferenceController@index');
    }

    public function search($keyword)
    {
        return $this->reference->search($keyword);
    }
}
