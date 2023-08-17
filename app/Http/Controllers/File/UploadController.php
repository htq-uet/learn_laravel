<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use Illuminate\Http\JsonResponse;

class UploadController extends Controller
{
    public function upload(FileRequest $request) : JsonResponse
    {
        $target_dir = "public/uploads/";
        if($request->hasFile('file')) {
            $file = $request->file('file');
//            if (file_exists($target_dir . $file->getClientOriginalName())) {
//                return response()->json([
//                    'message' => 'File already exists'
//                ]);
//            }

            $file->move($target_dir, $file->getClientOriginalName());
        }



        return response()->json([
            'message' => 'Upload success'
        ]);
    }
}
