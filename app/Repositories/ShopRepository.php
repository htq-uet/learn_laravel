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
            ->query()
            ->select('id')
            ->where('user_id', '=', $userID)
            ->first()->id;

        return $shopID;
    }


}
