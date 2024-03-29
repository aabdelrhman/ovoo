<?php

use App\Http\Controllers\Admin\AgencyController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\GiftController;
use App\Http\Controllers\Admin\InterestController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\RoomLevelController as AdminRoomLevelController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\GiftTypeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\InterestController as ControllersInterestController;
use App\Http\Controllers\RoomLevelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/upload-file', [FileController::class, 'uploadFile']);
    Route::post('/forget-password', [AuthController::class, 'forgetPassword']);
    Route::post('/verify-code', [AuthController::class, 'verifyCode']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
    route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('settings' , [SettingController::class, 'index']);
        Route::post('update-settings' , [SettingController::class, 'update']);
        Route::get('interests', [ControllersInterestController::class, 'getAllInterests']);
        Route::apiResource('interests', InterestController::class)->except('index');
        Route::get('countries', [CountriesController::class, 'getAllCountries']);
        Route::apiResource('countries', CountryController::class)->except('index');
        Route::get('banners', [BannerController::class, 'index']);
        Route::post('banners/{id}', [AdminBannerController::class, 'update']);
        Route::apiResource('banners', AdminBannerController::class)->except('index' , 'update');
        Route::apiResource('users', UserController::class);
        Route::apiResource('packages', PackageController::class);
        Route::get('room-levels', [RoomLevelController::class, 'index']);
        Route::apiResource('room-levels', AdminRoomLevelController::class)->except('index');
        Route::apiResource('categories', GiftTypeController::class);
        Route::apiResource('products', GiftController::class)->except('update');
        Route::post('products/{id}', [GiftController::class , 'update']);
        Route::post('block-user/{id}' , [UserController::class , 'blockUser']);
        Route::post('un-block-user/{id}' , [UserController::class , 'unBlockUser']);
        Route::get('rooms' , [RoomController::class , 'index']);
        Route::get('profile' , [ProfileController::class , 'show']);
        Route::post('profile' , [ProfileController::class , 'update']);
        Route::apiResource('agencies' , AgencyController::class)->only(['index' , 'store' , 'show']);
        Route::get('customized-gift-requests' , [GiftController::class , 'customizedGiftRequests']);
        Route::post('accept-customized-gift' , [GiftController::class , 'acceptCustomizedGift']);
        Route::get('blocked-users' , [UserController::class , 'blockedUsers']);
    });
});
