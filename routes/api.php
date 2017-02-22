<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


$api = app('Dingo\Api\Routing\Router');

# Public Actions
$api->version('v1', function ($api) {
        $api->post('google-login', 'App\Http\Controllers\Auth\LoginController@google');
//        $api->post('users/login', 'App\Http\Controllers\UserController@login');
//        $api->post('users/send-password-reset-code', 'App\Http\Controllers\UserController@sendPasswordResetCode');
//        $api->post('users/reset-password', 'App\Http\Controllers\UserController@setPassword');
});