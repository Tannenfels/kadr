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


Auth::routes();

Route::get('/', 'NewsController@list')->name('home');
Route::group(['prefix'=>'articles','as'=>'articles.'], function(){
    Route::get('/articles/{$id}-', ['as' => 'show', 'uses' => 'NewsController@show']);
});

