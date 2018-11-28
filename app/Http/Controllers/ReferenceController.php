<?php

namespace App\Http\Controllers;

use App\AOE\Repositories\Reference\ReferenceInterface;
use App\Http\Requests\ReferenceRequest;
use App\Employee;
use App\PrintingMachine;
use App\ProjectImages;
use \App\AOE\Repositories\PrintingMachine\EloquentPrintingMachine;
use App\Reference;

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
        $reference = $this->isReferenceClosed($reference);

        //Reference softcopies files
        $projectImage = new ProjectImages();
        $isUploaded = ($projectImage)->receiveAndCreat($request, 'upload_files_pdf', 'App\Reference', $reference->id, 'pdf', 'no_cover');
        $isUploaded = ($projectImage)->receiveAndCreat($request, 'upload_files_img', 'App\Reference', $reference->id, 'img', 'no_cover');

        //ReferenceMalfunction
        $this->reference->referenceMalfunctionsMaker($reference, $request, 'create');

        flash()->success(' تم إنشاء الإشارة بنجاح. ')->important();
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
        $reference = $this->isReferenceClosed($reference);

        //Reference softcopies files
        $projectImage = new ProjectImages();
        $isUploaded = ($projectImage)->receiveAndCreat($request, 'upload_files_pdf', 'App\Reference', $reference->id, 'pdf', 'no_cover');
        $isUploaded = ($projectImage)->receiveAndCreat($request, 'upload_files_img', 'App\Reference', $reference->id, 'img', 'no_cover');

        //ReferenceMalfunction
        $this->reference->referenceMalfunctionsMaker($reference, $request, 'update');

        flash()->success(' تم تعديل الإشارة بنجاح. ')->important();
        return redirect()->action('ReferenceController@show', ['id'=>$id]);
    }


    public function destroy($id)
    {
        $reference = $this->reference->getById($id);

        if (isset($reference->softCopies) && $reference->softCopies->isNotEmpty()) {
            $softCopiesIds = [];
            foreach($reference->softCopies as $softCopy) {
                $softCopiesIds[] = $softCopy->id;
            }
            $projectImage = new ProjectImages();
            $projectImage->deleteMultiProjectImages($softCopiesIds);
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

    public function searchingOnPrintingMachine($keyword)
    {
        $abc = new EloquentPrintingMachine(new PrintingMachine());
        return $abc->searchLimitedCodeCustomer($keyword);
    }

	public function createWithPrintingMachineId($printingMachineId)
    {
        $employeesNames = Employee::all()->pluck('user.name', 'id');
        $assignedEmployeesIds = (new PrintingMachine())->getAssignedEmployeesIds($printingMachineId);
        $selectedEmployeeIdByLink = !empty($assignedEmployeesIds)?($assignedEmployeesIds[0]):('');
        return view('references.create', compact('employeesNames', 'printingMachineId', 'selectedEmployeeIdByLink'));
    }
    
    public function closeTheReference($referenceId)
    {
        $reference = $this->reference->getById($referenceId);
        $reference->closing_date = now();
        $reference->status = 'مغلقة';
        $reference->save();
        return redirect()->action('ReferenceController@show', ['id'=>$reference->id]);
    }

    public function referencesDuringLastTwoWorkingDaysReport()
    {
        $references = $this->reference->referencesDuringLastTwoWorkingDaysReport()->paginate(15);
        return view('references.reports.references_report_during_last_two_working_days', compact('references'));
    }

    public function referencesStillOpenAfterFortyEightHoursReport()
    {
        $references =  $this->reference->referencesStillOpenAfterFortyEightHoursReport();
        return view('references.reports.references_still_open_after_forty_eight_hours_report', compact('references'));
    }

    public function isReferenceClosed(Reference $reference)
    {
        if($reference->status === 'مفتوحة') {
            $reference->closing_date = null;
            $reference->save();
        }
        return $reference;
    }

    public function getAllReferencesAsExcel()
    {
        return $this->reference->getAllReferencesAsExcel();
    }
}
