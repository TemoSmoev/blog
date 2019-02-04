<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;

class HomeController extends Controller
{
    public function index()
    {
        $posts=Post::paginate(3);
        
        $popularPosts=Post::orderBy('views','desc')->take(3)->get();
        $featuredPosts=Post::where('is_featured','1')->take(3)->get();
        $recentPosts=Post::orderBy('date','desc')->take(4)->get();
        $categories=Category::all();

        return view('pages.index',compact('posts','popularPosts','featuredPosts','recentPosts','categories'));
    }
    public function show($slug)
    {
        $post=Post::where('slug',$slug)->FirstOrFail();
        // dd($post);
        return view('pages.show',compact('post'));
    }
    public function tag($slug)
    {
        $tag=Tag::where('slug',$slug)->firstOrFail();
        $posts=$tag->posts()->where('status',1)->paginate(3);
        return view('pages.list',compact('posts'));
    }
    public function category($slug)
    {
        $category=Category::where('slug',$slug)->firstOrFail();
        $posts=$category->posts()->where('status',1)->paginate(3);
        return view('pages.list',compact('posts'));
    }
}
