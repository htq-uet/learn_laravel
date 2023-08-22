<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Services\ExportUserService;
use Illuminate\Http\Client\Request;

class GetUserExcelController extends Controller
{
    public function __construct(
        protected ExportUserService $exportUser
    )
    {
    }

    public function export()
    {
        return response()->json($this->exportUser->export());
    }
}
