<?php

use App\Http\Controllers\InterestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomGiftController;
use App\Http\Controllers\RoomLevelBackgroundController;
use App\Http\Controllers\RoomLevelController;
use App\Http\Controllers\VipTypeController;

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
        Route::post('edit-profile', 'editProfile');
        Route::get('get-profile', 'getProfile');
    });
    Route::get('settings', [SettingController::class, 'index']);
    Route::get('interests', [InterestController::class, 'getAllInterests']);
    Route::get('countries', [CountriesController::class, 'getAllCountries']);
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('complete-profile', [AuthController::class ,'completeProfile']);
        Route::get('room-levels', [RoomLevelController::class, 'index']);
        Route::get('level-backgrounds/{id}', [RoomLevelBackgroundController::class, 'index']);
        Route::post('create-room', [RoomController::class, 'store']);
        Route::get('banners', [BannerController::class, 'index']);
        Route::post('follow', [FollowerController::class, 'follow']);
        Route::post('unfollow', [FollowerController::class, 'unFollow']);
        Route::get('profile/{id}', [ProfileController::class, 'getProfile']);
        Route::post('update-profile', [ProfileController::class, 'updateProfile']);
        Route::post('sent-gift' , [RoomGiftController::class , 'sentGift']);
        Route::get('gifts-by-type/{id}' , [GiftController::class , 'index']);
        Route::get('gift-types' , [GiftController::class , 'giftTypes']);
        Route::get('user-supporters/{id}' , [ProfileController::class , 'userSupporters']);
        Route::apiResource('vip-types', VipTypeController::class)->only(['index', 'show']);
    });

});
