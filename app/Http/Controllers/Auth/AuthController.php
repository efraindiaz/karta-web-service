<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Platform\AdminModel;
use App\Models\Client\ClientModel;
use App\Models\Commerce\UserCommerceModel;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller{

	function __construct(){

		$this->karta = new AdminModel;
		$this->staff = new UserCommerceModel;
		$this->client = new ClientModel;

	}

	//Login para usuario administrador de Karta
	public function karta_login(Request $request){


		$session = $this->karta->login($request);

		if($session && !$session->isEmpty()){

			return $this->successResponse($session, 200);
		}

		return $this->errorResponse($session, 401);


	}


	//Login Controller para colaboradores del comercio
	public function commerce_login(Request $request){


		$session = $this->staff->login($request);

		if($session){
			if($request->has('fcm_token')){
				$id_staff = $session['id_info_user_commerce'];	
				$fcm_token = $request->fcm_token;

				//Save the fcm_token to user_info
				$staff_with_fcm_token = $this->staff->storeFCMTOKEN($id_user, $fcm_token);

				//return the user
		
				return $this->successResponse($staff_with_fcm_token, 200);	
			}

			return $this->successResponse($session, 200);
		}

		return $this->errorResponse($session, 401);

	}


	//Login Controller usuarios clientes
	public function client_login(Request $request){

		$session = $this->client->login($request);

		//if session is correct successfully
		if($session){
			
			//Validate if exist the fcm_token
			if($request->has('fcm_token')){
				$id_user = $session['id_info_user_consumer'];	
				$fcm_token = $request->fcm_token;

				//Save the fcm_token to user_info
				$user_with_fcm_token = $this->client->storeFCMTOKEN($id_user, $fcm_token);

				//return the user
						
				return $this->successResponse( $user_with_fcm_token, 200);			
			}

			return $this->successResponse($session, 200);
				
		}
		
		//if email or pass dont math return error
		return $this->errorResponse('', 401);
		
	}


}