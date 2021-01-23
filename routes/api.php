<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->namespace('Api\V1')->name('api.v1.')->group(function() {
    // 短信验证码 验证接口
    Route::post('verificationCodes', 'VerificationCodesController@store')->name('verificationCodes.store');

    // 用户注册
    Route::post('users', 'UsersController@store')->name('users.store');


});
