<?php

namespace App\Repositories;

use App\Models\Shop;

class ShopRepository extends Repository
{
    public function getModel() : string
    {
        return Shop::class;
    }

    public function getShopIdByUserId($userID)
    {
        $shopID = $this->_model
            ->select('id')
            ->where('user_id', '=', $userID)
            ->first();
        return $shopID;
    }
}
