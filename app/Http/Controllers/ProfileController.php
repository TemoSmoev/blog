<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\Rule;
use App\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        return view('pages.profile',compact('user'));
    }
    public function store(Request $request)
    {
        $user=Auth::user();

        $this->validate($request,[
            'name'=>'required',
            'email'=>[
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'avatar'=>'nullable|image'
        ]);
       
        $user->generatePassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));

        return redirect()->back()->with('status','профиль успешно обновлен');

    }
}
