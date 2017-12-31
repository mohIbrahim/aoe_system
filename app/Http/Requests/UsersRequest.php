<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->user;
        $userPassword = \Auth::user()->password;
        $resutl = [
            'current_password'=>'required',
            'current_password'=>'exists:users,password,id,'.$id,
            'password'=>'confirmed',
            'email'=>'required|email|unique:users,email,'.$id,
            'name'=>'required',
            'personal_image'=>'mimes:jpg,jpeg,png|nullable',
        ];

        if(\Hash::check($this->input('current_password'), $userPassword) || \Auth::user()->roles->pluck('name')->contains('Developer')){
            $resutl = [
                'current_password'=>'required',
                'password'=>'confirmed',
                'email'=>'required|email|unique:users,email,'.$id,
                'name'=>'required',
                'personal_image'=>'mimes:jpg,jpeg,png|nullable',
            ];
        }
        return $resutl;
    }
}
