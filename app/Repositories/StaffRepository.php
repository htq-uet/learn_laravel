<?php

namespace App\Repositories;

use App\Models\Staff;
use Illuminate\Support\Facades\DB;

class StaffRepository extends Repository
{
    public function getModel() : string
    {
        return Staff::class;
    }

    public function getStaffByShopId($shopId) {
//        DB::enableQueryLog(); // Enable query log

        $staffs = $this->_model
            ->select('*')
            ->where('shop_id', '=', $shopId)
            ->get();
//        dd(DB::getQueryLog()); // Show results of log

        return $staffs;
    }

    public function getShopIdByUserId($user_id)
    {
        $shopID = $this->_model
            ->select('shop_id')
            ->where('user_id', '=', $user_id)
            ->first()->shop_id;

        return $shopID;
    }

    public function getStaffIdByUserId($user_id)
    {
        $result = $this->_model
            ->select('id')
            ->where('user_id', '=', $user_id)
            ->first();

        $id = $result ? $result->id : null;

        return $id;

    }

}
