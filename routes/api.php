<?php

use App\Http\Controllers\InterestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\CountriesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1'], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/login-with-phone', 'loginWithPhone');
        Route::post('/verify-code', 'verifyCode');
        Route::post('signup-with-email', 'signUpWithEmail');
        Route::post('login-with-email', 'loginWithEmail');
        Route::post('social-auth', 'socialAuth');
        Route::post('send-verification-code', 'sendResetPasswordEmail');
        Route::post('reset-password', 'resetPassword');
        Route::post('resend-verification-code', 'resendVerificationCode');
        Route::post('complete-profile', 'completeProfile');
    });
    Route::get('settings', [SettingController::class, 'index']);
    Route::get('interests', [InterestController::class, 'getAllInterests']);
    Route::get('countries', [CountriesController::class, 'getAllCountries']);
});
