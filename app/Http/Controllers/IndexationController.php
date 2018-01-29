<?php

namespace App\Http\Controllers;

use App\AOE\Repositories\Indexation\IndexationInterface;
use App\Http\Requests\IndexationRequest;
use App\Reference;


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
        return view('indexations.create', compact('referencesIds'));
    }


    public function store(IndexationRequest $request)
    {
        $indexation = $this->indexation->create($request->all());
        flash()->success(' تم إضافة المقايسة بنجاح. ')->important();
        return redirect()->action('IndexationController@show', ['id'=>$indexation->id]);
    }


    public function show($id)
    {
        $indexation = $this->indexation->getById($id);
        return view('indexations.show', compact('indexation'));
    }


    public function edit($id)
    {
        $indexation = $this->indexation->getById($id);
        $referencesIds = Reference::all()->pluck('code', 'id');
        return view('indexations.edit', compact('indexation', 'referencesIds'));
    }


    public function update(IndexationRequest $request, $id)
    {
        $indexation = $this->indexation->update($id, $request->all());
        flash()->success(' تم تعديل المقايسة بنجاح. ')->important();
        return redirect()->action('IndexationController@show', ['id'=>$id]);
    }


    public function destroy($id)
    {
        $isDeleted = $this->indexation->delete($id);
        flash()->success(' تم حذف المقايسة بنجاح. ')->important();
        return redirect()->action('IndexationController@index');
    }

    public function search($keyword)
    {
        return $this->indexation->search($keyword);
    }
}
