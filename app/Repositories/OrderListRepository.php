<?php

namespace App\Repositories;

use App\Models\OrderList;

class OrderListRepository extends Repository
{
    public function getModel() : string
    {
        return OrderList::class;
    }
}
