<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    public function successResponse($data, $code){

    	return response()->json(['code'=>$code, 'data'=>$data]);
    }

    public function errorResponse($data, $code){

    	return response()->json(['code'=>$code, 'data'=>$data]);
    }
}
