<?php

namespace App\Http\Controllers\ManageProduct;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('token');
    }

    /**
     * Get all products
     */

    public function show(Request $request) : JsonResponse
    {
        $products = Product::query()->where('id', '>', $request->id ?? 0)->limit(10)->get();
//        $products =
//            DB::table('product')
//                ->select('*')
//                ->where('id', '>', $request->id ?? 0)
//                ->limit(10)
//                ->get();
        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }
}
