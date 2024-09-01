<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\auth\AuthController;
use App\Http\Controllers\API\auth\SafeController;
use App\Http\Controllers\API\organizationController;
use App\Http\Controllers\API\auth\passwordController;
use App\Http\Controllers\API\authenticationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('organization' , [organizationController::class, 'index' ]);
Route::get('org' , [organizationController::class, 'org' ]);
Route::get('profile/{user_id}' , [organizationController::class, 'profile' ]);
Route::get('alert/{user_id}' , [organizationController::class, 'alerts' ]);
Route::post('register' , [AuthController::class, 'register' ]);
Route::post('login' , [AuthController::class, 'login' ]);
Route::post('forgot_password' , [AuthController::class, 'forgot_password' ]);
Route::post('reset_password' , [passwordController::class, 'reset_password' ]);
Route::post('logout' , [AuthController::class, 'logout' ])->middleware('auth:sanctum');
Route::post('profile' , [AuthController::class, 'profileUpdate' ])->middleware('auth:sanctum');
Route::post('post_alert/{id}' , [organizationController::class, 'post_alert' ])->name('post_alert');