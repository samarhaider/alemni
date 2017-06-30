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
Route::get('users','Admin\UserController@index');
Route::get('user/{id}','Admin\UserController@show');
Route::get('user/{id}/block','Admin\UserController@blockUser');
Route::get('user/{id}/unblock','Admin\UserController@unblockUser');

Route::get('tuitions','Admin\TuitionController@index');
Route::get('tuition/{id}','Admin\TuitionController@show');
Route::get('users/{id}/tuitions/{tuition_id}','Admin\TuitionController@show');
Route::get('khairs','Admin\KhairController@index');
Route::get('khair/{id}/create','Admin\KhairController@create');
Route::post('khair/{id}','Admin\KhairController@store');
Route::get('khair/{id}/delete','Admin\KhairController@delete');
