<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
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

Route::post("/login", LoginController::class)->name("login");
Route::post("/register", RegisterController::class)->name("register");
Route::middleware("auth:sanctum")->group(function() {
    Route::apiResource("/post", PostController::class);
    Route::apiResource("/comment", CommentController::class);
    Route::get("/user/post", [Controller::class, "getUserPost"]);
    Route::post("/logout", LogoutController::class);
});