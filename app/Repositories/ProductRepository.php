<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductRepository extends Repository
{
    public function getModel() : string {
        return Product::class;
    }

    public function create(array $attributes) : Product {
        return Product::create([
            'name' => $attributes['name'],
            'price' => $attributes['price'],
            'shop_id' => $attributes['shop_id'],
            'staff_id' => $attributes['staff_id'],
        ]);
    }

    public function searchProduct($request) : Collection
    {
        return Product::query()
            ->where('name', 'like', '%' . $request->search . '%')
            ->where('id', '>', $request->id ?? 0)
            ->limit(5)
            ->get();
    }

    public function listProductByDateLike(mixed $year, mixed $month, mixed $day, $shop_id)
    {
        return $this->_model->query()
            ->select('product.id', 'product.name', 'product.price')
            ->where('product.shop_id', '=', $shop_id)
            ->where('product.id', '>', $request->id ?? 0)
            ->where(function ($query) use ($day, $month, $year){
                if(!is_null($day)) {
                    $query->whereDay('product.created_at', '=', $day);
                }
                if(!is_null($month)) {
                    $query->whereMonth('product.created_at', '=', $month);
                }
                if(!is_null($year)) {
                    $query->whereYear('product.created_at', '=', $year);
                }
            })
            ->orderByDesc('product.created_at');
    }

    public function countProductsByDate(mixed $year, mixed $month, mixed $day, $shop_id)
    {
        return $this->_model->query()
            ->select('product.id')
            ->where('shop_id', '=', $shop_id)
            ->when($year, function ($query, $year) {
                return $query->whereYear('created_at', $year);
            })
            ->when($month, function ($query, $month) {
                return $query->whereMonth('created_at', $month);
            })
            ->when($day, function ($query, $day) {
                return $query->whereDay('created_at', $day);
            })
            ->orderByDesc('product.created_at')
            ->count();

    }
}
