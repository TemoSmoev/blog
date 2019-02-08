<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => 'admin','namespace'=>'admin','middleware'=>'admin'], function () {
    Route::get('/','DashboardController@index');
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/tags', 'TagsController');
    Route::resource('/users', 'UsersController');
    Route::resource('/posts','PostsController');
    Route::get('/comments','CommentsController@index');
    Route::get('/comments/toggle/{id}','CommentsController@toggle');
    Route::delete('/comments/destroy/{id}','CommentsController@destroy')->name('comments.destroy');
    Route::resource('/subscribers','SubscribersController');
});

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/post/{slug}','HomeController@show')->name('post.show');
Route::get('/tag/{slug}','HomeController@tag')->name('tag.show');
Route::get('/category/{slug}','HomeController@category')->name('category.show');
Route::post('/subscribers/store','SubscribersController@store');
Route::get('/verify/{token}','SubscribersController@verify');

Route::group(['middleware'=>'guest'],function(){
    Route::get('/register','AuthController@register');
    Route::post('/register','AuthController@create');
    Route::get('/login','AuthController@loginForm')->name('login');
    Route::post('/login','AuthController@login');
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('/logout','AuthController@logout');
    Route::get('/profile','ProfileController@index');
    Route::post('/profile','ProfileController@store');
    Route::post('/comment','CommentsController@store');
});


