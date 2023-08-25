<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends Repository
{
    public function getModel() : string {
        return Product::class;
    }


}
