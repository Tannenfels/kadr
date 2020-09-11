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
Route::post('/comment_threads/store', 'ArticleController@storeCommentThread')->name('commentThreads.store')->middleware('auth');
Route::get('/forum', 'ForumController@list')->name('forum.list');
Route::get('/forum/{category}', 'ForumController@showCategory')->name('forum.category.show');

Route::middleware('admin')->group(function () {
    Route::get('/admin', 'AdminController@dashboard')->name('admin.dashboard');

    Route::get('/admin/destroy', 'AdminController@destroyArticle')->name('admin.article.destroy');
    Route::post('/admin/store_article', 'AdminController@storeArticle')->name('admin.article.store');
    Route::get('/admin/create_article', 'AdminController@createArticle')->name('admin.article.create');
    Route::post('/admin/article/update', 'AdminController@updateUser')->name('admin.article.update');
    Route::get('/admin/edit_article/{id}', 'AdminController@editArticle')->name('admin.article.edit');

    Route::get('/admin/users', 'AdminController@usersDashboard')->name('admin.user.dashboard');
    Route::get('/admin/users/{id}', 'AdminController@editUser')->name('admin.user.edit');
    Route::post('/admin/users/update', 'AdminController@updateUser')->name('admin.user.update');
});
