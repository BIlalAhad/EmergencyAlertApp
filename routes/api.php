<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\auth\AuthController;
use App\Http\Controllers\API\auth\SafeController;
use App\Http\Controllers\API\authenticationController;
// use App\Http\Controllers\API\organizationController;

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
Route::get('profile/{user_id}' , [organizationController::class, 'profile' ]);
Route::get('alert/{user_id}' , [organizationController::class, 'alerts' ]);
Route::post('register' , [AuthController::class, 'register' ]);
Route::post('login' , [AuthController::class, 'login' ]);
Route::post('forgot_password' , [AuthController::class, 'forgot_password' ]);
Route::post('reset_password' , [AuthController::class, 'reset_password' ]);
Route::post('logout' , [AuthController::class, 'logout' ])->middleware('auth:sanctum');
Route::post('profile' , [AuthController::class, 'profileUpdate' ])->middleware('auth:sanctum');