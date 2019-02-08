<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request,[
            'text'=>'required'
        ]);
        $comment=new Comment;
        $comment->text=$request->get('text');
        $comment->user_id=Auth::user()->id;
        $comment->post_id=$request->get('post_id');
        $comment->save();

        return redirect()->back()->with('coment_status','ваш комментарий скоро будет добавлен');
    }
}
