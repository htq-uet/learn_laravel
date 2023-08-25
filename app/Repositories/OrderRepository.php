<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends Repository
{
    public function getModel() : string
    {
        return Order::class;
    }

    public function getOrderByShopId($shopId) {
        $orders = $this->_model
            ->select('*')
            ->where('shop_id', '=', $shopId)
            ->get();

        return $orders;
    }

}
