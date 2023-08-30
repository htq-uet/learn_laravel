<?php

namespace App\Services;

use App\Http\Requests\CreateProductRequest;
use App\Repositories\ProductRepository;
use App\Repositories\ShopRepository;
use App\Repositories\StaffRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected ShopRepository $shopRepository,
        protected StaffRepository $staffRepository
    )
    {
    }

    public function create(CreateProductRequest $request)
    {
        $shop_id = $this->shopRepository->getShopIdByUserId(Auth::user()->id) ?? $this->staffRepository->getShopIdByUserId(Auth::user()->id);
        $staff_id = $this->staffRepository->getStaffIdByUserId(Auth::user()->id) ?? null;

        $request->merge([
            'shop_id' => $shop_id,
            'staff_id' => $staff_id,
        ]);

        return $this->productRepository->create($request->all());
    }

    public function searchProduct(Request $request)
    {
        return $this->productRepository->searchProduct($request);
    }
}
