<?php

namespace App\Http\Controllers;

use App\InstallationRecord;
use App\Http\Requests\InstallationRecordRequest;
use App\AOE\Repositories\InstallationRecord\InstallationRecordInterface;
use App\Employee;
use App\ProjectImages;
use App\AOE\Repositories\PrintingMachine\EloquentPrintingMachine;
use App\PrintingMachine;

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
        $employeesIdsNames = Employee::all()->pluck('user.name', 'id');
        return view('installation_records.create', compact('employeesIdsNames'));
    }

    /**
     * [store description]
     * @param  InstallationRecordRequest $request [description]
     * @return [type]                             [description]
     */
    public function store(InstallationRecordRequest $request)
    {
        $installationRecord = $this->installationRecord->create($request->all());

        $isUploaded = (new ProjectImages())->receiveAndCreat($request, 'installation_record_as_pdf', 'App\InstallationRecord', $installationRecord->id, 'pdf', 'no_cover');

        //InstallationRecordOtherItems
        if (null !== ($request->input('item_description')) &&  null !== ($request->input('item_name'))) {
            $itemNameArr = $request->input('item_name');
            $itemDescriptionArr = $request->input('item_description');

            if ( count($itemNameArr) == count($itemDescriptionArr) ) {
                foreach ($itemNameArr as $itemNameIterator => $itemName) {
                    $installationRecord->otherItems()->create(['item_name'=>$itemName, 'item_description'=>$itemDescriptionArr[$itemNameIterator]]);
                }
            }
        }

        flash()->success(' تم إنشاء محضر التركيب بنجاح. ')->important();
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
        $employeesIdsNames = Employee::all()->pluck('user.name', 'id');
        return view('installation_records.edit', compact('installationRecord', 'employeesIdsNames'));
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

        if ($request->hasFile('installation_record_as_pdf')) {
            $projectImage = new ProjectImages();
            if (isset($installationRecord->softCopies) && $installationRecord->softCopies->isNotEmpty()) {
                $projectImage->deleteOneProjectImage($installationRecord->softCopies->first()->id);
            }
            $isUploaded = $projectImage->receiveAndCreat($request, 'installation_record_as_pdf', 'App\InstallationRecord', $installationRecord->id, 'pdf', 'no_cover');
        }

        //InstallationRecordOtherItems
        $installationRecord->otherItems()->delete();
        if (null !== ($request->input('item_description')) &&  null !== ($request->input('item_name'))) {
            $itemNameArr = $request->input('item_name');
            $itemDescriptionArr = $request->input('item_description');
            if ( count($itemNameArr) == count($itemDescriptionArr) ) {
                foreach ($itemNameArr as $itemNameIterator => $itemName) {
                    $installationRecord->otherItems()->create(['item_name'=>$itemName, 'item_description'=>$itemDescriptionArr[$itemNameIterator]]);
                }
            }
        }

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
        $installationRecord = $this->installationRecord->getById($id);
        if (isset($installationRecord->softCopies) && $installationRecord->softCopies->isNotEmpty()) {
            $projectImage = new ProjectImages();
            $projectImage->deleteOneProjectImage($installationRecord->softCopies->first()->id);
        }
        $isDeleted = $this->installationRecord->delete($id);
        flash()->success(' تم حذف محضر التركيب بنجاح. ')->important();
        return redirect()->action('InstallationRecordController@index');
    }

    public function removeInstallationRecordFile($projectImageId)
    {
        $isUploaded = (new ProjectImages())->deleteOneProjectImage($projectImageId);
        return back()->withInput();
    }

    public function searchingOnPrintingMachine($keyword)
    {
        $abc = new EloquentPrintingMachine(new PrintingMachine());
        return $abc->searchLimitedCodeCustomer($keyword);
    }
}
