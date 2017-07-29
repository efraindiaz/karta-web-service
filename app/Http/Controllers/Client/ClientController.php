<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client\ClientModel;


class ClientController extends Controller{


	function __construct(){

        $this->client = new ClientModel;

        $this->middleware('auth', ['only' =>[
        		//'profile'
        	]]);    
    }

	public function create(Request $request){

		$newUser = $this->client->newUSer($request);

		return $newUser;
	}

	public function profile($id_user){

		$user = $this->client->getProfile($id_user);

		return $this->successResponse($user, 200);

	}

	public function update($id_user){

	}

}