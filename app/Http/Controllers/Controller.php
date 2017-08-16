<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
	//code
	//200 OK
	//201 Created 
	//400 Bad Request
	// 401 Unauthorized
	//404 Not found

    //
    public function successResponse($data, $code){

    	return response()->json(['code'=>$code, 'data'=>$data]);
    }

    public function errorResponse($data, $code){

    	//$resp = array("Error"=>"No match","Error"=>"No match");
    	return response()->json(['code'=>$code, 'data'=>$data]);
    }
}
