<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;

class CommentsController extends Controller
{
    public function index()
    {
        $comments=Comment::all();
        return view('admin.comments.index',compact('comments'));
    }
    public function toggle($id)
    {
        $comment=Comment::find($id);

        $comment->toggleStatus();
        return redirect()->back();
    }
    public function destroy($id)
    {
        $comment=Comment::find($id);
        $comment->remove();
        return redirect()->back()->with('status','the comment has been deleted');
    }
}
