<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{

    public function index()
    {
        $posts=Post::all();
        return view('admin.posts.index',compact('posts'));

    }

    public function create()
    {
        $categories=Category::pluck('title','id');
        $tags=Tag::pluck('title','id');
        return view('admin.posts.create',compact('categories','tags'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'date'=>'required',
            'image'=>'nullable|image'
        ]);
        $post=Post::add(request()->all());
        $post->uploadImage($request->file('image'));
        $post->setCategory(request('category_id'));
        $post->setTags(request('tags'));
        $post->toggleStatus(request('status'));
        $post->toggleFeatured(request('is_featured'));

        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        $categories=Category::pluck('title','id');
        $chosenCategory=$post->category_id;
        $tags=Tag::pluck('title','id');
        $chosenTags=$post->tags->pluck('id')->all();
        return view('admin.posts.edit',compact('post','categories','chosenCategory','tags','chosenTags','date'));
    }

    public function update(Request $request, Post $post)
    {
         $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'date'=>'required',
            'image'=>'nullable|image'
        ]);
        $post->edit(request()->all());
        $post->uploadImage($request->file('image'));
        $post->setCategory(request('category_id'));
        $post->setTags(request('tags'));
        $post->toggleStatus(request('status'));
        $post->toggleFeatured(request('is_featured'));

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->remove();
        return redirect()->route('posts.index');
    }
}
