<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Services\StaffService;

class StaffController extends Controller
{
    public function __construct(
        protected StaffService $staffService
    ) {
        $this->middleware([]);
    }

    public function create(CreateStaffRequest $request) {
        return response()->json([
            'status' => 'success',
            'data' => [$this->staffService->create($request)],
            'message' => 'create new staff'
        ]);
    }

    public function update(UpdateStaffRequest $request) {
        return response()->json([
            'status' => 'success',
            'data' => [$this->staffService->update($request)],
            'message' => 'update staff'
        ]);
    }

    public function getOwnStaffList() {
        return response()->json([
            'status' => 'success',
            'data' => [$this->staffService->getOwnStaffList()],
            'message' => 'get all staff'
        ]);
    }
}
