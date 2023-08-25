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

}
