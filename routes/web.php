<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/blog/category/{category}', 'WelcomeController@category')->name('blog.category');
Route::get('/blog/tag/{tag}', 'WelcomeController@tag')->name('blog.tag');

Route::get('/blog/{post}','WelcomeController@show')->name('blog.show');

Auth::routes();
Route::middleware(['auth'])->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories','CategoriesController');
    Route::resource('tags','TagsController');
    Route::resource('posts','PostsController');
    Route::delete('/trash/{post}', 'PostsController@trash')->name('posts.trash');
    Route::get('/trashed', 'PostsController@trashed')->name('posts.trashed');
    Route::put('/restore/{post}', 'PostsController@restore')->name('posts.restore');
});
Route::middleware(['auth','admin'])->group(function(){
    Route::get('/users','UsersController@index')->name('users.index');
    Route::put('/users/{user}/make-admin','UsersController@makeAdmin')->name('users.make-admin');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
