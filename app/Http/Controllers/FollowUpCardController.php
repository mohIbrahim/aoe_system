<?php

namespace App\Http\Controllers;

use App\AOE\Repositories\FollowUpCard\FollowUpCardInterface;
use App\Http\Requests\FollowUpCardRequest;
use App\ProjectImages;


class FollowUpCardController extends Controller
{
    private $followUpCard;

    public function __construct(FollowUpCardInterface $followUpCard)
    {
        $this->followUpCard = $followUpCard;
        $this->middleware('auth');
        $this->middleware('follow_up_cards');
    }

    public function index()
    {
        $followUpCards = $this->followUpCard->latest()->paginate(25);
        return view('follow_up_cards.index', compact('followUpCards'));
    }


    public function create()
    {
        $contracts = $this->followUpCard->contracts();
        return view('follow_up_cards.create', compact('contracts'));
    }


    public function store(FollowUpCardRequest $request)
    {
        $followUpCard = $this->followUpCard->create($request->all());

        $isUploaded = (new ProjectImages())->receiveAndCreat($request, 'follow_up_card_as_pdf', 'App\FollowUpCard', $followUpCard->id, 'pdf', 'no_cover');

        flash()->success(' تم إضافة بطاقة المتابعة بنجاح. ')->important();
        return redirect()->action('FollowUpCardController@show', ['id'=>$followUpCard->id]);
    }


    public function show($id)
    {
        $followUpCard = $this->followUpCard->getById($id);
        return view('follow_up_cards.show', compact('followUpCard'));
    }


    public function edit($id)
    {
        $followUpCard = $this->followUpCard->getById($id);
        $contracts = $this->followUpCard->contracts();
        return view('follow_up_cards.edit', compact('followUpCard', 'contracts'));
    }


    public function update(FollowUpCardRequest $request, $id)
    {
        $followUpCard = $this->followUpCard->update($id, $request->all());

        if ($request->hasFile('follow_up_card_as_pdf')) {
            $projectImage = new ProjectImages();
            if (isset($followUpCard->softCopies) && $followUpCard->softCopies->isNotEmpty()) {
                $projectImage->deleteOneProjectImage($followUpCard->softCopies->first()->id);
            }
            $isUploaded = $projectImage->receiveAndCreat($request, 'follow_up_card_as_pdf', 'App\FollowUpCard', $followUpCard->id, 'pdf', 'no_cover');
        }

        flash()->success(' تم تعديل بطاقة المتابعة بنجاح. ')->important();
        return redirect()->action('FollowUpCardController@show', ['id'=>$id]);
    }


    public function destroy($id)
    {
        $followUpCard = $this->followUpCard->getById($id);
        if (isset($followUpCard->softCopies) && $followUpCard->softCopies->isNotEmpty()) {
            $projectImage = new ProjectImages();
            $projectImage->deleteOneProjectImage($followUpCard->softCopies->first()->id);
        }
        $isDeleted = $this->followUpCard->delete($id);
        flash()->success(' تم حذف بطاقة المتابعة بنجاح. ')->important();
        return redirect()->action('FollowUpCardController@index');
    }

    public function search($keyword)
    {
        return $this->followUpCard->search($keyword);
    }

    public function removeFollowUpCardFile($projectImageId)
    {
        $isUploaded = (new ProjectImages())->deleteOneProjectImage($projectImageId);
        return back()->withInput();
    }
}
