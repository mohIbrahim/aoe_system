<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UsersRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Hash;
use App\ProjectImages;


use Auth;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('users')->except(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $rolesArray = $roles->pluck('name', 'id');
        return view('users.edit', compact('user','rolesArray'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $currentPassword = $request->current_password;

        //Personal Image process
        $projectImages = new ProjectImages();
        //create
        if ( $request->hasFile('personal_image') && $user->images->isEmpty() )
        {
            $result = $projectImages-> receiveAndCreat($request, 'personal_image','App\User', $user->id, 'comment');
        }
        //Delete the image only
        if ($request->input('delete_image') && !$request->hasFile('personal_image'))
		{
			$personalImageId = $request->input('delete_image');
			$projectImages->deleteOneProjectImage($personalImageId);
            return back()->withInput();
		}
        if($request->hasFile('personal_image') && $user->images->isNotEmpty())
        {
            //UPLOAD AND Delete
            //Poject Image id to delete it
            $pojectImageId = $request->input('project_image_id');
            $projectImages->deleteOneProjectImage($pojectImageId);
            //create
            $result = $projectImages-> receiveAndCreat($request, 'personal_image','App\User', $user->id, 'comment');
        }

        //Hashing new password
        if(!empty($request->password) && isset($request->password))
        {
            $user->password = Hash::make($request->password);
        }

        $user->update($request->except(['personal_image', 'password']));

        flash()->success('User has been updated successfully');
        return redirect()->action('HomeController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $projectImages = new ProjectImages();
        foreach($user->images as $image){
            $projectImages->deleteOneProjectImage($image->id);
        }
        $isDeleted = $user->delete();
         if($isDeleted){
            flash()->success('User has been deleted successfully');
            return redirect('users');
        }else{
            flash()->warning('Can not delete that user at this time');
            return redirect('users');
        }
    }


    private function deleteFile($source){
        if(file_exists($source)){
            unlink($source);
        }
    }

}
