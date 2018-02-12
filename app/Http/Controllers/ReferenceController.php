<?php

namespace App\Http\Controllers;

use App\AOE\Repositories\Reference\ReferenceInterface;
use App\Http\Requests\ReferenceRequest;
use App\Employee;
use App\PrintingMachine;
use App\ProjectImages;


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
        $printingMachineIdsCodes = PrintingMachine::all()->pluck('code', 'id');
        return view('references.create', compact('employeesNames', 'printingMachineIdsCodes'));
    }


    public function store(ReferenceRequest $request)
    {
        $reference = $this->reference->create($request->all());

        $isUploaded = (new ProjectImages())->receiveAndCreat($request, 'reference_as_pdf', 'App\Reference', $reference->id, 'pdf', 'no_cover');

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
        $printingMachineIdsCodes = PrintingMachine::all()->pluck('code', 'id');
        return view('references.edit', compact('reference', 'employeesNames', 'printingMachineIdsCodes'));
    }


    public function update(ReferenceRequest $request, $id)
    {
        $reference = $this->reference->update($id, $request->all());

        if ($request->hasFile('reference_as_pdf')) {
            $projectImage = new ProjectImages();
            if (isset($reference->softCopies) && $reference->softCopies->isNotEmpty()) {
                $projectImage->deleteOneProjectImage($reference->softCopies->first()->id);
            }
            $isUploaded = $projectImage->receiveAndCreat($request, 'reference_as_pdf', 'App\Reference', $reference->id, 'pdf', 'no_cover');
        }

        flash()->success(' تم تعديل الإشارة بنجاح. ')->important();
        return redirect()->action('ReferenceController@show', ['id'=>$id]);
    }


    public function destroy($id)
    {
        $reference = $this->reference->getById($id);

        if (isset($reference->softCopies) && $reference->softCopies->isNotEmpty()) {
            $projectImage = new ProjectImages();
            $projectImage->deleteOneProjectImage($reference->softCopies->first()->id);
        }

        $this->reference->delete($id);
        flash()->success(' تم حذف الإشارة بنجاح. ')->important();
        return redirect()->action('ReferenceController@index');
    }

    public function search($keyword)
    {
        return $this->reference->search($keyword);
    }

    public function removeReferenceFile($projectImageId)
    {
        $isUploaded = (new ProjectImages())->deleteOneProjectImage($projectImageId);
        return back()->withInput();
    }
}
