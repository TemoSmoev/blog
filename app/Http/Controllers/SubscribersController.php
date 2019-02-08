<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use App\Mail\SubscribeEmail;

class SubscribersController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email|unique:subscriptions'
        ]);
        $sub=Subscription::add($request->get('email'));
        $sub->renderToken();

        \Mail::to($sub)->send(new SubscribeEmail($sub));

        return redirect()->back()->with('status','проверьте вашу почту');
    }
    public function verify($token)
    {
        $sub=Subscription::where('token',$token)->firstOrFail();
        $sub->token=null;
        $sub->save();
        return redirect('/')->with('status','your email is verified');
    }
}
