<?php

namespace App\Http\Controllers;

use App\AOE\Repositories\FollowUpCard\FollowUpCardInterface;
use App\Http\Requests\FollowUpCardRequest;


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
        return view('follow_up_cards.create');
    }


    public function store(FollowUpCardRequest $request)
    {
        $followUpCard = $this->followUpCard->create($request->all());
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
        return view('follow_up_cards.edit', compact('followUpCard'));
    }


    public function update(FollowUpCardRequest $request, $id)
    {
        $followUpCard = $this->followUpCard->update($id, $request->all());
        flash()->success(' تم تعديل بطاقة المتابعة بنجاح. ')->important();
        return redirect()->action('FollowUpCardController@show', ['id'=>$id]);
    }


    public function destroy($id)
    {
        $isDeleted = $this->followUpCard->delete($id);
        flash()->success(' تم حذف بطاقة المتابعة بنجاح. ')->important();
        return redirect()->action('FollowUpCardController@index');
    }

    public function search($keyword)
    {
        return $this->followUpCard->search($keyword);
    }
}
