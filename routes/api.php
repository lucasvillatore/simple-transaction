<?php

use App\Interfaces\Http\Controllers\TransactionController;
use App\Interfaces\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


Route::post("/user", [UserController::class, "create"]);
Route::get("/user", [UserController::class, "index"]);
Route::post("/transaction", [TransactionController::class, "create"]);