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
Route::get('/articles/{id}', 'NewsController@show')->name('show');


Route::get('/page-id-{id}.html', 'NewsController@legacyShow');
Route::get('/page.php', 'NewsController@legacyUnpluginedShow');

Auth::routes();

Route::get('/', 'NewsController@list')->name('home');
Route::redirect('/home', '/');
Route::get('/admin', 'AdminController@dashboard')->middleware('admin');

Route::middleware('admin')->group(function () {
    Route::get('/admin', 'AdminController@dashboard')->name('admin.dashboard');

    Route::get('/admin/destroy', 'AdminController@destroyNews')->name('admin.destroyNews');
    Route::get('/admin/edit_article/{id}', 'AdminController@editNews')->name('admin.editNews');
});
