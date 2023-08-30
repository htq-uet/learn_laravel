<?php

namespace App\Services;

use App\Http\Requests\DateRequest;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ShopRepository;
use Illuminate\Support\Facades\Auth;

class ReportService
{
    public function __construct(
        protected ShopRepository $shopRepository,
        protected OrderRepository $orderRepository,
        protected ProductRepository $productRepository
    )
    {}

    public function getReportByDate(DateRequest $request) {
        try {
            $shop_id = $this->shopRepository->getShopIdByUserId(Auth::user()->id);
        }
        catch (\Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

        if (is_null($shop_id)) {
            return null;
        }

        try {
            $orderReport = $this->orderRepository->listOrderByDateLike(
                $request->year,
                $request->month,
                $request->day,
                $shop_id
            );

            $countOrder =
                $this->orderRepository->countOrdersByDate(
                $request->year,
                $request->month,
                $request->day,
                $shop_id
            );
        }
        catch (\Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }



        try {
            $productReport = $this->productRepository->listProductByDateLike(
                $request->year,
                $request->month,
                $request->day,
                $shop_id
            );

            $countProduct = $this->productRepository->countProductsByDate(
                $request->year,
                $request->month,
                $request->day,
                $shop_id
            );
        }
        catch (\Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }


        return ([
            'orderReport' => $orderReport->limit(100)->get(),
            'countOrder' => $countOrder,
            'productReport' => $productReport->limit(100)->get(),
            'countProduct' => $countProduct,
        ]);
    }
}
