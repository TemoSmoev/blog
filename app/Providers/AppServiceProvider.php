<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Post;

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
