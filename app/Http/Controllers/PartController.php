<?php

namespace App\Http\Controllers;

use App\Part;
use Illuminate\Http\Request;
use App\AOE\Repositories\Part\PartInterface;
use App\Http\Requests\PartRequest;

class PartController extends Controller
{
    private $part;

    public function __construct(PartInterface $part)
    {
        $this->part = $part;
        $this->middleware('auth');
        $this->middleware('parts');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parts = $this->part->latest()->paginate(25);
        return view('parts.index', compact('parts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartRequest $request)
    {
        $part = $this->part->create($request->all());
        return redirect()->action('PartController@show', ['id'=>$part->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $part = $this->part->getById($id);
        return view('parts.show', compact('part'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $part = $this->part->getById($id);
        return view('parts.edit', compact('part'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function update(PartRequest $request, $id)
    {
        $part = $this->part->update($id, $request->all());
        return redirect()->action('PartController@show', ['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = $this->part->delete($id);
        return redirect()->action('PartController@index');
    }

    public function search($keyword)
    {
        return $this->part->search($keyword);
    }
}
