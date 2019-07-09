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

Route::post('login', 'PassportController@login');
Route::post('register', 'PassportController@register');
Route::get('signup/activate/{token}', 'PassportController@SignUpActivate');
//Route::get('/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');


Route::middleware('auth:api')->group(function () {
    Route::get('user', 'PassportController@details');
    Route::apiResource('Article','ArticleController');
});



//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

