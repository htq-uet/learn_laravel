<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageProduct\ProductController;

Route::prefix('v1')->group(function (){
    Route::get('/product_list',[ProductController::class, 'show']);
    Route::post('/create_new_product',[ProductController::class, 'create']);
    Route::get('/search_product',[ProductController::class, 'searchProduct']);
});
