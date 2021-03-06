<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitRequest;
use App\AOE\Repositories\Visit\VisitInterface;
use App\PrintingMachine;
use App\FollowUpCard;
use App\Employee;
use App\Reference;
use \App\AOE\Repositories\PrintingMachine\EloquentPrintingMachine;
use \App\ProjectImages;

class VisitController extends Controller
{

    private $visit;

    public function __construct(VisitInterface $visit)
    {
        $this->visit = $visit;
        $this->middleware('auth');
        $this->middleware('visits');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visits = $this->visit->latest()->paginate(25);
        return view('visits.index', compact('visits'));
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
        $followUpCardsIdsCodes = FollowUpCard::all()->pluck('code', 'id');
        $employeesIdsNames = Employee::all()->pluck('user.name', 'id');
        $referencesIdsCodes = Reference::all()->pluck('code', 'id');
        return view('visits.create', compact('followUpCardsIdsCodes', 'employeesIdsNames', 'referencesIdsCodes'));
    }

    /**
     * [store description]
     * @param  VisitRequest $request [description]
     * @return [type]                  [description]
     */
    public function store(VisitRequest $request)
    {
        $visit = $this->visit->create($request->all());

        $projectImage = new ProjectImages();
        $isUploaded = ($projectImage)->receiveAndCreat($request, 'upload_files_pdf', 'App\Visit', $visit->id, 'pdf', 'no_cover');
        $isUploaded = ($projectImage)->receiveAndCreat($request, 'upload_files_img', 'App\Visit', $visit->id, 'img', 'no_cover');
        
        flash()->success(' تم إنشاء الزيارة بنجاح. ')->important();
        return redirect()->action('VisitController@show', ['id'=>$visit->id]);
    }

    /**
     * [show description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
        $visit = $this->visit->getById($id);
        return view('visits.show', compact('visit'));
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        $visit = $this->visit->getById($id);
        $followUpCardsIdsCodes = FollowUpCard::all()->pluck('code', 'id');
        $employeesIdsNames = Employee::all()->pluck('user.name', 'id');
        $referencesIdsCodes = Reference::all()->pluck('code', 'id');
        return view('visits.edit', compact('visit', 'followUpCardsIdsCodes', 'employeesIdsNames', 'referencesIdsCodes'));
    }

    /**
     * [update description]
     * @param  VisitRequest $request [description]
     * @param  [type]         $id      [description]
     * @return [type]                  [description]
     */
    public function update(VisitRequest $request, $id)
    {
        $visit = $this->visit->update($id, $request->all());

        $projectImage = new ProjectImages();
        $isUploaded = ($projectImage)->receiveAndCreat($request, 'upload_files_pdf', 'App\Visit', $visit->id, 'pdf', 'no_cover');
        $isUploaded = ($projectImage)->receiveAndCreat($request, 'upload_files_img', 'App\Visit', $visit->id, 'img', 'no_cover');
        
        flash()->success(' تم تعديل الزيارة بنجاح. ')->important();
        return redirect()->action('VisitController@show', ['id'=>$id]);
    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        $visit = $this->visit->getById($id);

        if (isset($visit->softCopies) && $visit->softCopies->isNotEmpty()) {
            $softCopiesIds = [];
            foreach($visit->softCopies as $softCopy) {
                $softCopiesIds[] = $softCopy->id;
            }
            $projectImage = new ProjectImages();
            $projectImage->deleteMultiProjectImages($softCopiesIds);
        }
        
        $isDeleted = $this->visit->delete($id);
        flash()->success(' تم حذف الزيارة بنجاح. ')->important();
        return redirect()->action('VisitController@index');
    }
    /**
     * [search description]
     * @param  [type] $keyword [description]
     * @return [type]          [description]
     */
    public function search($keyword)
    {
        return $this->visit->search($keyword);
    }

    public function searchingOnPrintingMachine($keyword)
    {
        $abc = new EloquentPrintingMachine(new PrintingMachine());
        return $abc->searchLimitedCodeCustomer($keyword);
    }

	public function createWithPrintingMachineId($printingMachineId)
    {
        $followUpCardsIdsCodes = FollowUpCard::all()->pluck('code', 'id');
        $employeesIdsNames = Employee::all()->pluck('user.name', 'id');
        $referencesIdsCodes = Reference::all()->pluck('code', 'id');

        return view('visits.create', compact('followUpCardsIdsCodes', 'employeesIdsNames', 'referencesIdsCodes', 'printingMachineId'));
    }

    public function createWithPrintingMachineIdAndFollowUpCardId($printingMachineId, $followUpCardId)
    {
        $followUpCardsIdsCodes = FollowUpCard::all()->pluck('code', 'id');
        $employeesIdsNames = Employee::all()->pluck('user.name', 'id');
        $referencesIdsCodes = Reference::all()->pluck('code', 'id');
        $type = 'بطاقة المتابعة';
        $visit = (object)['printing_machine_id'=>$printingMachineId, 'follow_up_card_id'=>$followUpCardId, 'type'=>$type];

        return view('visits.create', compact('followUpCardsIdsCodes', 'employeesIdsNames', 'referencesIdsCodes', 'visit'));
    }

    public function createWithPrintingMachineIdAndReferenceId($printingMachineId, $referenceId, $employeeId)
    {
        $followUpCardsIdsCodes = FollowUpCard::all()->pluck('code', 'id');
        $employeesIdsNames = Employee::where('job_title', 'مهندس صيانة')->get()->pluck('user.name', 'id');
        $referencesIdsCodes = Reference::all()->pluck('code', 'id');
        $type = 'إشارة';
        $visit = (object)['printing_machine_id'=>$printingMachineId, 'reference_id'=>$referenceId, 'type'=>$type, 'the_employee_who_made_the_visit_id'=>$employeeId];
        return view('visits.create', compact('followUpCardsIdsCodes', 'employeesIdsNames', 'referencesIdsCodes', 'visit'));
    }

    public function removeVisitFile($projectImageId)
    {
        $isUploaded = (new ProjectImages())->deleteOneProjectImage($projectImageId);
        return back()->withInput();
    }

    public function indexVisitsInSpecificPeriodReport()
    {
        return view('visits.reports.visits_in_specific_period');
    }
    
    public function getVisitsInSpecificPeriodReport($from, $to)
    {
        return $this->visit->getVisitsInSpecificPeriodReport($from, $to);
    }

    /**
     * Getting all visits as ecxel sheet.
     */
    public function getAllVisitsAsExcel()
    {
        return $this->visit->getAllVisitsAsExcel();
    }
}
