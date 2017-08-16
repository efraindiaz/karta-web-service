<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client\ClientModel;
use Illuminate\Support\Facades\Hash;


class ClientController extends Controller{


	function __construct(){

        $this->client = new ClientModel;

        $this->middleware('auth', ['only' =>[
        		//'profile'
        	]]);    
    }

	public function create(Request $request){


		/*Password hash verification*/
		//Hash::check('password', $password)

		//Obtiene el email del request

		$email = $request->input('email');


		//Llama modelo para validar email
		$checkEmail = $this->client->checkEmail($email);

		//Valida si el correo ya existe
		if($checkEmail && !$checkEmail->isEmpty()){

			return $this->errorResponse($request->all(), 400);

		}	
		//Si no existe el correo procede a crear al nuevo usuario
		else{

			//Encripta la contraseña de usuario		
			$password = Hash::make($request->input('password'));//app('hash')->make($request->input('password'));
			//Generar un token para usuario nuevo
			$token = str_random(50);
			//Integrar password y token al request
			$secureFields = ['password' => $password, 'token' => $token];

			$request->merge($secureFields);

			//Llama modelo para crear nueva cuenta de usuario
			$createUser = $this->client->newUSer($request);

			//Si se creo exitosamente	
			if($createUser){

				return $this->successResponse($createUser, 200);
			}
		}
		
		//Si hubo algun problema al crear usuario
		return $this->errorResponse($request->all(), 401);

	}

	public function profile($id_user){

		$user = $this->client->getProfile($id_user);

		return $this->successResponse($user, 200);

	}

	public function update($id_user, Request $request){

	}

}