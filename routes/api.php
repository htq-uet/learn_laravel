<?php

use App\Http\Controllers\File\GetUserExcelController;
use App\Http\Controllers\ManageProduct\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StaffController;
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

Route::prefix('v1')->middleware(['token','auth:api', 'api',  'role:SHOP'])->group(function () {
    Route::post('/create_new_staff', [StaffController::class, 'create']);
    Route::put('/update_staff', [StaffController::class, 'update']);
    Route::get('/get_staff_list', [StaffController::class, 'getOwnStaffList']);
});

Route::prefix('v1')->middleware(['token','auth:api', 'api',  'role:SHOP'])->group(function () {
    Route::post('/create_new_order', [OrderController::class, 'create']);
});

Route::prefix('v1')->middleware([])->group(function () {
    Route::get('/report', [ReportController::class, 'getReportByDate']);
});
