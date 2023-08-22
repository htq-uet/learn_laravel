<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{

    public function getModel() : string
    {
        // TODO: Implement getModel() method.
        return User::class;
    }

    public function getAdminUser() {
        return $this->getModel()::join('shop', 'shop.user_id', '=', 'user.id')
            ->where('user.role', 'SHOP')
            ->select('shop.*', 'user.username')
            ->get()
//            ->map(function ($item){
//                return [
//                    'id' => $item->id,
//                    'name' => $item->name,
//                    'username' => $item->username,
//                    'address' => $item->address,
//                    'phone' => $item->phone,
//                ];
//
//            })
            ;
    }

    public function getStaffUser() {
        return $this->getModel()::join('staff', 'staff.user_id', '=', 'user.id')
            ->where('user.role', 'STAFF')
            ->select('staff.*', 'user.username')
            ->get()
            ->map(function ($item){
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'username' => $item->username,
                    'address' => null,
                    'phone' => $item->phone,
                ];

            });
    }

}
