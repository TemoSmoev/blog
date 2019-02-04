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
});

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/post/{slug}','HomeController@show')->name('post.show');
Route::get('/tag/{slug}','HomeController@tag')->name('tag.show');
Route::get('/category/{slug}','HomeController@category')->name('category.show');

Route::group(['middleware'=>'guest'],function(){
    Route::get('/register','AuthController@register');
    Route::post('/register','AuthController@create');
    Route::get('/login','AuthController@loginForm')->name('login');
    Route::post('/login','AuthController@login');
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('/logout','AuthController@logout');
});


