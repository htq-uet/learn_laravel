<?php

use App\Http\Controllers\File\UploadController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
    'middleware' => 'api'
], function (){
    Route::post("/upload_file", [UploadController::class, "upload"]);

});
