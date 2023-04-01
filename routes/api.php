<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ItemController;

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

Route::group(['middleware' => 'api'], function($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/checklist', [ChecklistController::class, 'index']);
    Route::post('/checklist', [ChecklistController::class, 'store']);
    Route::delete('/checklist/{checklistId}', [ChecklistController::class, 'destroy']);

    Route::get('/checklist/{checklistId}/item', [ItemController::class, 'getItem']);
    Route::post('/checklist/{checklistId}/item', [ItemController::class, 'store']);

    Route::get('/checklist/{checklistId}/item/{checklistItemId}', [ItemController::class, 'show']);
    Route::put('/checklist/{checklistId}/item/{checklistItemId}', [ItemController::class, 'logout']);
    Route::delete('/checklist/{checklistId}/item/{checklistItemId}', [ItemController::class, 'destroy']);

    Route::put('/checklist/{checklistId}/item/rename/{checklistItemId}', [ItemController::class, 'rename']);
});
