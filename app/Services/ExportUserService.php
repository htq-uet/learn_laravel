<?php

namespace App\Services;

use App\Exports\UserExport;
use App\Repositories\UserRepository;
use Illuminate\Http\Client\Request;

class ExportUserService
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {
    }

    public function export()
    {

        try {
            $user = $this->userRepository->getAdminUser();

//        $user = $this->userRepository->getStaffUser();

            $userExport = new UserExport($user);

            $fileName = date("YmdHis") . uniqid();
            \Maatwebsite\Excel\Facades\Excel::store($userExport, $fileName . '.xlsx', 'uploads');


            return response()->json([
                'message' => 'Export success',
                'file_name' => $fileName
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }
}
