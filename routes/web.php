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
Route::get('/articles/{id}', 'ArticleController@show')->name('show');


Route::get('/page-id-{id}.html', 'ArticleController@legacyShow');
Route::get('/page.php', 'ArticleController@legacyUnpluginedShow');

Auth::routes();

Route::get('/', 'ArticleController@list')->name('home');
Route::redirect('/home', '/');
Route::get('/admin', 'AdminController@dashboard')->middleware('admin');
Route::get('/users/{id}', 'UserController@show')->name('user.show')->middleware('auth');

Route::middleware('admin')->group(function () {
    Route::get('/admin', 'AdminController@dashboard')->name('admin.dashboard');

    Route::get('/admin/destroy', 'AdminController@destroyNews')->name('admin.news.destroy');
    Route::get('/admin/edit_article/{id}', 'AdminController@editNews')->name('admin.news.edit');
    Route::post('/admin/create_article', 'AdminController@storeNews')->name('admin.news.store');

    Route::get('/admin/users', 'AdminController@usersDashboard')->name('admin.user.dashboard');
    Route::get('/admin/users/{id}', 'AdminController@editUser')->name('admin.user.edit');
    Route::get('/admin/users/update', 'AdminController@updateUser')->name('admin.user.update');
});
