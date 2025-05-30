<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\OrderWorkerController;
use App\Http\Controllers\WorkerController;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Laravel\Passport\Token;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('passport')->group(function () {
    Route::post('/token', [AuthController::class, 'login']);
    Route::post('/token/refresh', [AuthController::class, 'refresh']);
    Route::get('/tokens', [AuthController::class, 'tokens'])->middleware('auth:api');
    Route::delete('/tokens/{token_id}', [AuthController::class, 'revoke'])->middleware('auth:api');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

    Route::get('/clients', [AuthController::class, 'clients'])->middleware('auth:api');
    Route::put('/clients/{client_id}', [AuthController::class, 'updateClient']);


    Route::delete('/passport/clients/{client_id}', [AuthController::class, 'deleteClient'])->middleware('auth:api');
    Route::get('/scopes', [AuthController::class, 'scopes'])->middleware('auth:api');
    Route::get('/personal-access-tokens', [AuthController::class, 'getPersonalTokens'])->middleware('auth:api');
    Route::post('/personal-access-tokens', [AuthController::class, 'createPersonalToken'])->middleware('auth:api');
    Route::delete('/personal-access-tokens/{token_id}', [AuthController::class, 'deletePersonalToken'])->middleware('auth:api');
});

Route::get('/sessions', [AuthController::class, 'getActiveSessions'])->middleware('auth:api');
Route::delete('/sessions/{token_id}', [AuthController::class, 'revokeSession'])->middleware('auth:api');
Route::post('/orders', [OrderController::class, 'store'])->middleware('auth:api');
Route::post('/orders/{orderId}/assign-worker', [OrderWorkerController::class, 'assignWorkerToOrder']);
Route::get('/workers/filter', [WorkerController::class, 'filterByOrderTypes']);

