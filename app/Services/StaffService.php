<?php

namespace App\Services;

use App\Http\Requests\CreateStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\Staff;
use App\Models\User;
use App\Repositories\ShopRepository;
use App\Repositories\StaffRepository;
use Illuminate\Support\Facades\Auth;

class StaffService
{
public function __construct(
        protected ShopRepository $shopRepository,
        protected StaffRepository $staffRepository
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
        try {
            $staff = Staff::find($request->id);
            $staff->name = $request->name ?? $staff->name;
            $staff->phone = $request->phone ?? $staff->phone;
            $staff->status = $request->status ?? $staff->status;
            $staff->save();

            if ($request->password) {
//                dd($staff);
                $user = User::find($staff->user_id);
//                dd($user);
                $user->password = bcrypt($request->password);
                $user->save();
            }
            return $staff;
        }
        catch (\Exception $exception) {
            return $exception;
        }
    }

    public function getOwnStaffList() {
        $shop_id = $this->shopRepository->getShopIdByUserId(Auth::user()->id);
        return $this->staffRepository->getStaffByShopId($shop_id);
    }

}
