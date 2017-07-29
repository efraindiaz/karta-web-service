<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client\ClientModel;
use App\Models\Commerce\UserCommerceModel;


class AuthController extends Controller{

	function __construct(){

		$this->staff = new UserCommerceModel;
		$this->client = new ClientModel;

	}


	public function karta_login(){

	}


	//Login Controller for commerce user
	public function commerce_login(Request $request){


		$session = $this->staff->login($request);

		if($session){
			return $this->successResponse($session, 200);
		}

		return $this->errorResponse($session, 404);

	}


	//Login Controller for user
	public function client_login(Request $request){

		$session = $this->client->login($request);

		if($session){
				
			return $this->successResponse($session, 200);
			
		}


		return $this->errorResponse($session, 400);
		
		
		
	}


}