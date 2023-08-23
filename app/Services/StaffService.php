<?php

namespace App\Services;

use App\Http\Requests\CreateStaffRequest;
use App\Models\Staff;
use App\Models\User;
use App\Repositories\ShopRepository;
use Illuminate\Support\Facades\Auth;

class StaffService
{
public function __construct(
        protected ShopRepository $shopRepository
    ) {
    }

    public function create(CreateStaffRequest $request) : array
    {
        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'STAFF'
        ]);

        $shop_id = $this->shopRepository->getShopIdByUserId(Auth::user()->id);


        $staff = Staff::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'user_id' => $user->id,
            'shop_id' => $shop_id->id,
            'status' => 'active',
        ]);

        $data = [
            'user' => $user,
            'staff' => $staff
        ];

        return $data;
    }

    public function update(UpdateStaffRequest $request) {



        $staff = Staff::find($request->id);
        $staff->name = $request->name;
        $staff->phone = $request->phone;
        $staff->status = $request->status;
        $staff->password = bcrypt($request->password);
        $staff->save();
        return $staff;
    }
}
