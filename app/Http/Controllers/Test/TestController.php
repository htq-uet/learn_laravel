<?php

namespace App\Http\Controllers\Test;

use App\Exceptions\TokenException;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    /**
     */
    public function test() : bool
    {
        try {
            throw new TokenException();
        } catch (TokenException $e) {
            report($e);

            dd("oke");
        }
    }
}
