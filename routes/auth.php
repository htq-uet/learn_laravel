<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'v1',
    'middleware' => 'api'
], function (){
    Route::post("/auth/login", [AuthController::class, "login"]);
    Route::post("/auth/register", [AuthController::class, "register"]);
    Route::get("/logout", [AuthController::class, "logout"]);
    Route::get("/refresh", [AuthController::class, "refresh"]);
    Route::get("/user-profile", [AuthController::class, "userProfile"]);

});
