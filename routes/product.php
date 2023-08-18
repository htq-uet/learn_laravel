<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageProduct\ProductController;

Route::prefix('v1')->group(function (){
    Route::get('/product_list',[ProductController::class, 'show']);
});
