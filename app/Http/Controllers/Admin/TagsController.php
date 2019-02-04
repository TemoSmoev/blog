<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;

class TagsController extends Controller
{
    
    public function index()
    {
        $tags=Tag::all();
        return view('admin.tags.index',compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,['title'=>'required']);
        Tag::create($request->all());
        return redirect()->route('tags.index');
       
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit',compact('tag'));
    }

    public function update(Request $request,Tag $tag)
    {
        $this->validate(request(),['title'=>'required']);

        $tag->update(request()->all());
        return redirect()->route('categories.index');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index');
    }
}
