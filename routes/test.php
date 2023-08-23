<?php

use App\Http\Controllers\Test\TestController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('api', 'token', 'role:SHOP')->group(function () {
    Route::get('/test', [TestController::class, 'test']);
});
