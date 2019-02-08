<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;
use App\Comment;

class HomeController extends Controller
{
    public function index()
    {
        $posts=Post::paginate(3);
        
        return view('pages.index',compact('posts','popularPosts','featuredPosts','recentPosts','categories'));
    }
    public function show($slug)
    {
        $post=Post::where('slug',$slug)->FirstOrFail();

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
