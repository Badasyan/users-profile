<?php

use App\Http\Controllers\UserController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('/register', [UserController::class, 'store']);
Route::middleware('auth:sanctum')->get('/profile', [UserController::class, 'show']);
Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'index']);

