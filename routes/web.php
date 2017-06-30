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

Route::get('/login', function () {
    return view('admin/login');
});
Route::post('/login','Admin\LoginController@login');
Route::post('/logout','Admin\LoginController@logout');
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('users','Admin\UserController@index')->middleware('auth.basic');
Route::get('user/{id}','Admin\UserController@show')->middleware('auth.basic');
Route::get('user/{id}/block','Admin\UserController@blockUser')->middleware('auth.basic');
Route::get('user/{id}/unblock','Admin\UserController@unblockUser')->middleware('auth.basic');

Route::get('tuitions','Admin\TuitionController@index')->middleware('auth.basic');
Route::get('tuition/{id}','Admin\TuitionController@show')->middleware('auth.basic');
Route::get('users/{id}/tuitions/{tuition_id}','Admin\TuitionController@show')->middleware('auth.basic');
Route::get('khairs','Admin\KhairController@index')->middleware('auth.basic');
Route::get('khair/{id}/create','Admin\KhairController@create')->middleware('auth.basic');
Route::post('khair/{id}','Admin\KhairController@store')->middleware('auth.basic');
Route::get('khair/{id}/delete','Admin\KhairController@delete')->middleware('auth.basic');
