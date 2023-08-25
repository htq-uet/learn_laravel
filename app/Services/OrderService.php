<?php

namespace App\Services;

use App\Http\Requests\CreateOrderRequest;
use App\Repositories\OrderListRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ShopRepository;
use App\Repositories\StaffRepository;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function __construct(
        protected OrderRepository $orderRepository,
        protected ProductRepository $productRepository,
        protected ShopRepository $shopRepository,
        protected StaffRepository $staffRepository,
        protected OrderListRepository $orderListRepository
    ) {
    }

    /**
     * @throws \Exception
     */
    public function create(CreateOrderRequest $request) : array {
        $shop_id = $this->shopRepository->getShopIdByUserId(Auth::user()->id) ?? $this->staffRepository->getShopIdByUserId(Auth::user()->id);
        $staff_id = $this->staffRepository->getStaffIdByUserId(Auth::user()->id);

        $createOrder = [
            'shop_id' => $shop_id,
            'staff_id' => $staff_id,
        ];

        $order = $this->orderRepository->create($createOrder);

        $arr = ($request->product_ids);

        $product_ids = [array_keys($arr)];
        $quantity = [array_values($arr)];

        for ($i = 0; $i < count($product_ids[0]); $i++) {
//            $product = $this->productRepository->findById($product_ids[0][$i]);
////            if ($product->quantity < $quantity[0][$i]) {
////                throw new \Exception('Product ' . $product->name . ' is out of stock');
////            }
//            $product->quantity = $quantity[0][$i];
//            $product->save();

            $this->orderListRepository->create([
                'order_id' => $order->id,
                'product_id' => $product_ids[0][$i],
                'quantity' => $quantity[0][$i]['quantity']
            ]);
        }

        return [
            'order' => $order,
            'request' => $request->all()
        ];
    }
}
