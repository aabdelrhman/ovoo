<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\InterestController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\RoomLevelController as AdminRoomLevelController;
use App\Http\Controllers\Admin\SettingController;
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
        Route::apiResource('banners', AdminBannerController::class)->except('index');
        Route::apiResource('users', UserController::class);
        Route::apiResource('packages', PackageController::class);
        Route::get('room-levels', [RoomLevelController::class, 'index']);
        Route::apiResource('room-levels', AdminRoomLevelController::class)->except('index');
    });
});
