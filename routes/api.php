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
    $api->post('login/google/{user_type}', 'App\Http\Controllers\Auth\LoginController@google');
//    $api->post('login/{user_type}', 'App\Http\Controllers\Auth\LoginController@simple');
    $api->post('login', 'App\Http\Controllers\Auth\LoginController@simple');
    $api->post('users/register/student', 'App\Http\Controllers\UserController@student');
    $api->post('users/register/tutor', 'App\Http\Controllers\UserController@tutor');
//        $api->post('users/login', 'App\Http\Controllers\UserController@login');
//        $api->post('users/send-password-reset-code', 'App\Http\Controllers\UserController@sendPasswordResetCode');
//        $api->post('users/reset-password', 'App\Http\Controllers\UserController@setPassword');
});

# Private Actions
$api->version('v1', ['middleware' => 'jwt.auth'], function ($api) {
    $api->post('users/avatar', 'App\Http\Controllers\UserController@avatar');
    $api->get('users/questionnaires', 'App\Http\Controllers\UserController@questionnairesList');
    $api->post('users/questionnaires', 'App\Http\Controllers\UserController@updateQuestionnaires');
    $api->post('users/{id}', 'App\Http\Controllers\UserController@update');
    $api->resource('users', 'App\Http\Controllers\UserController');
    $api->resource('questions', 'App\Http\Controllers\QuestionController');
//    $api->resource('answers', 'App\Http\Controllers\AnswerController');
    $api->post('tutions/{id}/finished', 'App\Http\Controllers\TutionController@finished');
    $api->post('tutions/{id}/rate', 'App\Http\Controllers\TutionController@rate');
    $api->resource('tutions', 'App\Http\Controllers\TutionController');
    $api->get('messages/unread-messages-count', 'App\Http\Controllers\MessageController@UnreadMessagesCount');
    $api->post('messages/read-thread', 'App\Http\Controllers\MessageController@ReadThread');
    $api->resource('messages', 'App\Http\Controllers\MessageController');
    $api->post('proposals/{id}', 'App\Http\Controllers\ProposalController@update');
    $api->post('proposals/withdrawl/{id}', 'App\Http\Controllers\ProposalController@withdrawl');
    $api->post('proposals/accept/{id}', 'App\Http\Controllers\ProposalController@accept');
    $api->post('proposals/reject/{id}', 'App\Http\Controllers\ProposalController@reject');
    $api->resource('proposals', 'App\Http\Controllers\ProposalController');
    $api->post('invitations/{id}', 'App\Http\Controllers\InvitationController@update');
    $api->post('invitations/accept/{id}', 'App\Http\Controllers\InvitationController@accept');
    $api->post('invitations/reject/{id}', 'App\Http\Controllers\InvitationController@reject');
    $api->resource('invitations', 'App\Http\Controllers\InvitationController');
});
