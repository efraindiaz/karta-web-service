<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client\ClientModel;


class ClientController extends Controller{


	function __construct(){

        $this->client = new ClientModel;    
    }

	public function create(Request $request){

		$newUser = $this->client->newUSer($request);

		return $newUser;
	}

	public function profile($id_user){

	}

	public function update($id_user){

	}

}