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
        $_order = $this->_model
            ->select('*')
            ->where('shop_id', '=', $shopId)
            ->get();

        return $_order;
    }

    public function listOrderByDateLike(mixed $year, mixed $month, mixed $day, $shop_id)
    {
        return $this->_model->query()
            ->selectRaw('_order.id, IFNULL(SUM(product.price * order_list.quantity), 0) AS total_price')
            ->leftJoin('order_list', 'order_list.order_id', '=', '_order.id')
            ->leftJoin('product', 'product.id', '=', 'order_list.product_id')
            ->where('_order.shop_id', '=', $shop_id)
            ->where('_order.id', '>', $request->id ?? 0)
            ->where(function ($query) use ($day, $month, $year){
                if(!is_null($day)) {
                   $query->whereDay('_order.created_at', '=', $day);
                }
                if(!is_null($month)) {
                    $query->whereMonth('_order.created_at', '=', $month);
                }
                if(!is_null($year)) {
                    $query->whereYear('_order.created_at', '=', $year);
                }
            })
            ->orderByDesc('_order.created_at')
            ->groupBy('_order.id')
            ;
    }

    public function countOrdersByDate(mixed $year, mixed $month, mixed $day, $shop_id)
    {
        return $this->_model->query()
            ->select('_order.id')
            ->where('_order.shop_id', '=', $shop_id)
            ->where(function ($query) use ($day, $month, $year){
                if(!is_null($day)) {
                    $query->whereDay('_order.created_at', '=', $day);
                }
                if(!is_null($month)) {
                    $query->whereMonth('_order.created_at', '=', $month);
                }
                if(!is_null($year)) {
                    $query->whereYear('_order.created_at', '=', $year);
                }
            })
            ->orderByDesc('_order.created_at')
            ->count()
            ;
    }

}
