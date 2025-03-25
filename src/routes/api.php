<?php

use App\Http\Controllers\ExplorerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\UserController;
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
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])
    ->middleware('auth:sanctum');

Route::resource('/explorer', ExplorerController::class)
    ->middleware('auth:sanctum');
Route::post('/explorer/trade', [ExplorerController::class, 'trade']);
Route::resource('/item', ItemController::class)
    ->middleware('auth:sanctum');
Route::resource('/localization', LocalizationController::class);
