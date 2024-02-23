<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('auth/facebook',[AuthController::class, 'facebook']);
Route::get('auth/facebook/callback', [AuthController::class, 'facebookCallback']);

Route::group(['prefix' => 'v1'], function () {
    Route::post('/login-with-phone' , [AuthController::class, 'loginWithPhone']);
    Route::post('/verify-code' , [AuthController::class, 'verifyCode']);
    Route::post('signup-with-email' , [AuthController::class , 'signUpWithEmail']);
    Route::post('login-with-email' , [AuthController::class , 'loginWithEmail']);
});
