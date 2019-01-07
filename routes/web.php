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

// route to index method
Route::get('/', 'PagesController@index');

// route to about method
Route::get('/about', 'PagesController@about');

// route to services method
Route::get('/services', 'PagesController@services');

// route to designer download image file sent by customer
Route::get('/show/{id}', 'PostsController@downloadimage')->name('downloadFile');

// write route to multiple route
Route::resource('posts', 'PostsController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

// route to display user method
Route::get('/displayuser', 'PostsController@displayuser');

// route to edit user method
Route::get('/edituser/{id}', 'PostsController@edituser');

// route to create user method
Route::get('/createuser', 'PostsController@createuser');

// route to store user method
Route::post('/storeuser', 'PostsController@storeuser');

// route to update user method
Route::post('/updateuser/{id}', 'PostsController@updateuser');

// route to delete method
Route::post('/destroyuser/{id}', 'PostsController@destroyuser');

// route to design method
Route::get('/posts/{id}/design', 'PostsController@design');

// route to send draft method
Route::post('/design/{id}', 'PostsController@senddraft');

// route to cust view draft image method
Route::get('/posts/{id}/draft', 'PostsController@viewdraft');

// route to send draft method
Route::post('/draft/{id}', 'PostsController@confirmdraft');

Route::post('/posts/{id}', 'PostsController@manageaction');

