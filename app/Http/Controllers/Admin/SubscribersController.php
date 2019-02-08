<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscription;

class SubscribersController extends Controller
{
    public function index()
    {
        $subs=Subscription::all();
        return view('admin.subscribers.index',compact('subs'));
    }

    public function create()
    {
        return view('admin.subscribers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email|unique:subscriptions'
        ]);
        
        $sub=new Subscription;
        $sub->add($request->email);
        return redirect()->route('subscribers.index')->with('status','the subscriber has been added successfully');
    }

    public function destroy($id)
    {
        $sub=Subscription::find($id);
        $sub->remove();

        return redirect()->back();
    }

}
