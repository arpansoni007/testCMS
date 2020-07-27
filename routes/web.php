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



Route::middleware(['auth'])->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');

    /* ----------------------------- Category Routes ---------------------------- */
    Route::resource('categories','CategoriesController');
    Route::get('categories/{id}/destroy', 'CategoriesController@destroy')->name('categories.destroy');


    /* ------------------------------ Posts Routes ------------------------------ */
    Route::resource('posts','PostsController');
    Route::post('posts/{id}', 'PostsController@update')->name('posts.update');

    /* ------------------------------ Trashed Posts ----------------------------- */
    Route::get('trashed-posts','PostsController@trashed')->name('trashed-posts.index');


    /* ------------------------------ Restore Posts ----------------------------- */
    Route::put('posts-restore/{id}','PostsController@restore')->name('posts.restore');
});