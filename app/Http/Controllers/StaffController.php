<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStaffRequest;
use App\Services\StaffService;

class StaffController extends Controller
{
    public function __construct(
        protected StaffService $staffService
    ) {
        $this->middleware(['role:SHOP', 'token', 'api']);
    }

    public function create(CreateStaffRequest $request) {
        return response()->json([
            'status' => 'success',
            'data' => [$this->staffService->create($request)],
            'message' => 'create new staff'
        ]);
    }
}
