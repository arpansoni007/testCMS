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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth'])->group(function(){

    Route::get('/page/{page}', 'PageController')->name('page')->where('page','home|about');

    /* ----------------------------- Category Routes ---------------------------- */
    Route::get('categories/{id}/destroy', 'CategoriesController@destroy')->name('categories.destroy');
    Route::resource('categories','CategoriesController');


    /* ------------------------------ Posts Routes ------------------------------ */
    Route::resource('posts','PostsController');
    Route::post('posts/{id}', 'PostsController@update')->name('update.posts');

    /* ------------------------------ Trashed Posts ----------------------------- */
    Route::get('trashed-posts','PostsController@trashed')->name('trashed-posts.index');


    /* ------------------------------ Restore Posts ----------------------------- */
    Route::put('posts-restore/{id}','PostsController@restore')->name('posts.restore');
});