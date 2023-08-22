<?php

use App\Http\Controllers\File\GetUserExcelController;
use Illuminate\Support\Facades\Route;

include __DIR__ . "/auth.php";
include __DIR__ . "/upload_file.php";
include __DIR__ . "/test.php";
include __DIR__ . "/product.php";

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

Route::prefix('v1')->middleware('api')->group(function () {
    Route::get('/get_excel', [GetUserExcelController::class, 'export']);
});



