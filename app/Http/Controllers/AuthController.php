<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('pages.register');
    }
    public function create(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required'
        ]);
        
        $user=User::add($request->all());
        $user->generatePassword(request('password'));

        return redirect()->route('login');
    }
    public function loginForm()
    {
        return view('pages.login');
    }
    public function login(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt([
            'email' => request('email'),
            'password' => request('password')
         ])){
             return redirect('/');
         }
         else{
            return redirect()->back()->with('status','неправильный логин или пароль');
         }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
