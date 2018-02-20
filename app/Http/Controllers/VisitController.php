<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitRequest;
use App\AOE\Repositories\Visit\VisitInterface;
use App\PrintingMachine;
use App\FollowUpCard;
use App\Employee;
use App\Reference;
use \App\AOE\Repositories\PrintingMachine\EloquentPrintingMachine;

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
        flash()->success(' تم إضافة الزيارة بنجاح. ')->important();
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
}
