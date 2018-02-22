<?php

namespace App\Http\Controllers;

use App\AOE\Repositories\FollowUpCardSpecialReport\FollowUpCardSpecialReportInterface;
use App\Http\Requests\FollowUpCardSpecialReportRequest;
use App\FollowUpCard;

class FollowUpCardSpecialReportController extends Controller
{
    private $followUpCardSpecialReport;

    public function __construct(FollowUpCardSpecialReportInterface $followUpCardSpecialReport)
    {
        $this->followUpCardSpecialReport = $followUpCardSpecialReport;
        $this->middleware('auth');
        $this->middleware('follow_up_card_special_reports');
    }

    public function index()
    {
        $followUpCardSpecialReports = $this->followUpCardSpecialReport->latest()->paginate(25);
        return view('follow_up_card_special_reports.index', compact('followUpCardSpecialReports'));
    }

    public function create()
    {
        $followUpCardsIdsCodes = FollowUpCard::all()->pluck('code', 'id');
        return view('follow_up_card_special_reports.create', compact('followUpCardsIdsCodes'));
    }

    public function store(FollowUpCardSpecialReportRequest $request)
    {
        $followUpCardSpecialReport = $this->followUpCardSpecialReport->create($request->all());
        flash()->success(' تم إنشاء بطاقة المتابعة بنجاح. ')->important();
        return redirect()->action('FollowUpCardSpecialReportController@show', ['id'=>$followUpCardSpecialReport->id]);
    }

    public function show($id)
    {
        $followUpCardSpecialReport = $this->followUpCardSpecialReport->getById($id);
        return view('follow_up_card_special_reports.show', compact('followUpCardSpecialReport'));
    }


    public function edit($id)
    {
        $followUpCardSpecialReport = $this->followUpCardSpecialReport->getById($id);
        $followUpCardsIdsCodes = FollowUpCard::all()->pluck('code', 'id');
        return view('follow_up_card_special_reports.edit', compact('followUpCardSpecialReport', 'followUpCardsIdsCodes'));
    }

    public function update(FollowUpCardSpecialReportRequest $request, $id)
    {
        $followUpCardSpecialReport = $this->followUpCardSpecialReport->update($id, $request->all());
        flash()->success(' تم تعديل بطاقة المتابعة بنجاح. ')->important();
        return redirect()->action('FollowUpCardSpecialReportController@show', ['id'=>$id]);
    }

    public function destroy($id)
    {
        $isDeleted = $this->followUpCardSpecialReport->delete($id);
        flash()->success(' تم حذف بطاقة المتابعة بنجاح. ')->important();
        return redirect()->action('FollowUpCardSpecialReportController@index');
    }

    public function search($keyword)
    {
        return $this->followUpCardSpecialReport->search($keyword);
    }

	public function createWithFollowUpCardId($follow_up_card_id)
    {
		$followUpCardsIdsCodes = FollowUpCard::all()->pluck('code', 'id');
        return view('follow_up_card_special_reports.create', compact('followUpCardsIdsCodes', 'follow_up_card_id'));
    }
}
