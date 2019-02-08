<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Post;
use App\Comment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('pages._sidebar', function ($view) {
            $view->with('popularPosts',Post::getPopularPosts());
            $view->with('featuredPosts',Post::getFeaturedPosts());
            $view->with('recentPosts',Post::getRecentPosts());
            $view->with('categories',Post::getCategories());
        });
        view()->composer('admin.layout',function($view){
            $view->with('newCommentsCount',Comment::where('status','0')->count());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
