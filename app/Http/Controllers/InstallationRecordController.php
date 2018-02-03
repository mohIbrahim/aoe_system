<?php

namespace App\Http\Controllers;

use App\InstallationRecord;
use App\Http\Requests\InstallationRecordRequest;
use App\AOE\Repositories\InstallationRecord\InstallationRecordInterface;
use App\Employee;

class InstallationRecordController extends Controller
{
    private $installationRecord;

    public function __construct(InstallationRecordInterface $installationRecord)
    {
        $this->installationRecord = $installationRecord;
        $this->middleware('auth');
        $this->middleware('installation_records');
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        $installationRecords = $this->installationRecord->latest()->paginate(25);
        return view('installation_records.index', compact('installationRecords'));
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
        $contractsOfGuarantee = $this->installationRecord->contractOfGuarantee();
        $employeesIdsNames = Employee::all()->pluck('user.name', 'id');
        return view('installation_records.create', compact('contractsOfGuarantee', 'employeesIdsNames'));
    }

    /**
     * [store description]
     * @param  InstallationRecordRequest $request [description]
     * @return [type]                             [description]
     */
    public function store(InstallationRecordRequest $request)
    {
        $installationRecord = $this->installationRecord->create($request->all());
        flash()->success(' تم إضافة محضر التركيب بنجاح. ')->important();
        return redirect()->action('InstallationRecordController@show', ['id'=>$installationRecord->id]);
    }

    /**
     * [show description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
        $installationRecord = $this->installationRecord->getById($id);
        return view('installation_records.show', compact('installationRecord'));
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        $installationRecord = $this->installationRecord->getById($id);
        $contractsOfGuarantee = $this->installationRecord->contractOfGuarantee();
        $employeesIdsNames = Employee::all()->pluck('user.name', 'id');
        return view('installation_records.edit', compact('installationRecord', 'contractsOfGuarantee', 'employeesIdsNames'));
    }

    /**
     * [update description]
     * @param  InstallationRecordRequest $request [description]
     * @param  [type]                    $id      [description]
     * @return [type]                             [description]
     */
    public function update(InstallationRecordRequest $request, $id)
    {
        $installationRecord = $this->installationRecord->update($id, $request->all());
        flash()->success(' تم تعديل محضر التركيب بنجاح. ')->important();
        return redirect()->action('InstallationRecordController@show', ['id'=>$id]);
    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        $isDeleted = $this->installationRecord->delete($id);
        flash()->success(' تم حذف محضر التركيب بنجاح. ')->important();
        return redirect()->action('InstallationRecordController@index');
    }
}
