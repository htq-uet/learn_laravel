<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService
    ) {
        $this->middleware([]);
    }

    public function create(CreateOrderRequest $request)  {
        try {
            $order = $this->orderService->create($request);
            return $order;
        }
        catch (\Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }
}
