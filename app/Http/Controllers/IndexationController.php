<?php

namespace App\Http\Controllers;

use App\AOE\Repositories\Indexation\IndexationInterface;
use App\Http\Requests\IndexationRequest;
use App\Reference;
use App\Visit;
use App\ProjectImages;
use App\AOE\Repositories\PrintingMachine\EloquentPrintingMachine;
use App\PrintingMachine;
use App\Employee;
use App\AOE\Repositories\Employee\EloquentEmployee;
use App\Indexation;


class IndexationController extends Controller
{
    private $indexation;

    public function __construct(IndexationInterface $indexation)
    {
        $this->indexation = $indexation;
        $this->middleware('auth');
        $this->middleware('indexations');
    }

    public function index()
    {
        $indexations = $this->indexation->latest()->paginate(25);
        return view('indexations.index', compact('indexations'));
    }


    public function create()
    {
        $referencesIds = Reference::all()->pluck('code', 'id');
        $visitsIds = Visit::all()->pluck('id', 'id');
        $employeesNamesIds = (new EloquentEmployee(new Employee()))->getEmployeesOfMaintenanceEnginerRoleNamesIds();
        return view('indexations.create', compact('referencesIds', 'visitsIds', 'employeesNamesIds'));
    }

    public function store(IndexationRequest $request)
    {
        $indexation = $this->indexation->create($request->all());

        $projectImage = new ProjectImages();
        $isUploaded = ($projectImage)->receiveAndCreat($request, 'upload_files_pdf', 'App\Indexation', $indexation->id, 'pdf', 'no_cover');
        $isUploaded = ($projectImage)->receiveAndCreat($request, 'upload_files_img', 'App\Indexation', $indexation->id, 'img', 'no_cover');

        $this->indexationPartAttachment($request, $indexation);

        flash()->success(' تم إنشاء المقايسة بنجاح. ')->important();
        return redirect()->action('IndexationController@show', ['id'=>$indexation->id]);
    }


    public function show($id)
    {
        $indexation = $this->indexation->getById($id);
        $statement = $indexation->statementOfRequiredParts();
        $statementOfRequiredParts = $statement[0];
        $totalPriceWithTax = $statement[1];
        $totalPriceWithoutTax = $statement[2];
        $totalTax = $statement[3];
        return view('indexations.show', compact('indexation', 'statementOfRequiredParts', 'totalPriceWithTax', 'totalPriceWithoutTax', 'totalTax'));
    }


    public function edit($id)
    {
        $indexation = $this->indexation->getById($id);
        $referencesIds = Reference::all()->pluck('code', 'id');
        $visitsIds = Visit::all()->pluck('id', 'id');
        $parts = $indexation->parts;
        $employeesNamesIds = (new EloquentEmployee(new Employee()))->getEmployeesOfMaintenanceEnginerRoleNamesIds();
        return view('indexations.edit', compact('indexation', 'referencesIds', 'visitsIds', 'parts', 'employeesNamesIds'));
    }


    public function update(IndexationRequest $request, $id)
    {
        $indexation = $this->indexation->update($id, $request->all());

        $projectImage = new ProjectImages();
        $isUploaded = ($projectImage)->receiveAndCreat($request, 'upload_files_pdf', 'App\Indexation', $indexation->id, 'pdf', 'no_cover');
        $isUploaded = ($projectImage)->receiveAndCreat($request, 'upload_files_img', 'App\Indexation', $indexation->id, 'img', 'no_cover');

        $indexation->parts()->detach();
        $this->indexationPartAttachment($request, $indexation);

        flash()->success(' تم تعديل المقايسة بنجاح. ')->important();
        return redirect()->action('IndexationController@show', ['id'=>$id]);
    }


    public function destroy($id)
    {
        $indexation = $this->indexation->getById($id);

        if (isset($indexation->softCopies) && $indexation->softCopies->isNotEmpty()) {
            $softCopiesIds = [];
            foreach($indexation->softCopies as $softCopy) {
                $softCopiesIds[] = $softCopy->id;
            }
            $projectImage = new ProjectImages();
            $projectImage->deleteMultiProjectImages($softCopiesIds);
        }

        $isDeleted = $this->indexation->delete($id);

        flash()->success(' تم حذف المقايسة بنجاح. ')->important();
        return redirect()->action('IndexationController@index');
    }

    public function search($keyword)
    {
        return $this->indexation->search($keyword);
    }

    public function indexationFormPartSearch($keyword)
    {
        return $this->indexation->searchFormPart($keyword);
    }

    public function removeIndexationFile($projectImageId)
    {
        $isUploaded = (new ProjectImages())->deleteOneProjectImage($projectImageId);
        return back()->withInput();
    }
    
    public function createIndexationWithVisitId($visitIdFromPrintingMachine)
    {
        $referencesIds = Reference::all()->pluck('code', 'id');
        $visitsIds = Visit::all()->pluck('id', 'id');
        $indexation = (object)['type'=>"زيارة"];
        return view('indexations.create', compact('referencesIds', 'visitsIds', 'visitIdFromPrintingMachine', 'indexation'));
    }

    public function getIndexationsReleasedInSpecificPeriodReport()
    {
        return view('indexations.reports.indexations_released_in_specific_period_report');
    }
    
    public function IndexationsReleasedInSpecificPeriodReportSearch($from, $to)
    {
        $results = $this->indexation->indexationsReleasedInSpecificPeriodReportSearch($from, $to);
        return $results;
    }

    public function ajaxSearchingOnPrintingMachine($keyword)
    {
        $abc = new EloquentPrintingMachine(new PrintingMachine());
        return $abc->searchLimitedCodeCustomer($keyword);
    }

    public function indexationPartAttachment(IndexationRequest $request, Indexation $indexation): void
    {
        $partsIds                   = ($request->parts_ids)?($request->parts_ids):([]);
        $partsPricesWithoutTax      = $request->parts_prices_without_tax;
        $partsPrices                = $request->parts_prices;
        $partsSerial                = $request->parts_serial_numbers;
        $partcount                  = $request->parts_count;
        $discountRate               = $request->discount_rate;
        $descriptions               = $request->parts_descriptions;
        for ($i=0; $i < count($partsIds); $i++) {
            $indexation->parts()->attach([
                                            $partsIds[$i]=> [
                                                                'price_without_tax'=>$partsPricesWithoutTax[$i],
                                                                'price'=>$partsPrices[$i],
                                                                'serial_number'=>$partsSerial[$i],
                                                                'number_of_parts'=>$partcount[$i],
                                                                'discount_rate'=>$discountRate[$i],
                                                                'part_description'=>$descriptions[$i],
                                                            ]
                                        ]);
        }
    }
}
