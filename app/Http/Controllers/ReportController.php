<?php

namespace App\Http\Controllers;

use App\Http\Requests\DateRequest;
use App\Services\ReportService;

class ReportController extends Controller
{
    public function __construct(
        protected ReportService $reportService
    )
    {
        $this->middleware([]);
    }

    public function getReportByDate(DateRequest $request) {
        if(is_null($request->getContent())) {
            $request->merge([
                'year' => date('Y'),
                'month' => date('m'),
                'day' => date('d'),
            ]);
        }

        $report = $this->reportService->getReportByDate($request);

        //nếu tồn tại lỗi trong report thì trả về lỗi
        if (isset($report['error'])) {
            return response()->json([
                'status' => 'error',
                'data' => [],
                'message' => $report['error']
            ]);
        }
        else {
            return response()->json([
                'status' => 'success',
                'data' => [$report],
                'message' => 'get report'
            ]);
        }
    }
}
