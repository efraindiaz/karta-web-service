<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use PDOException;
use Illuminate\Support\Facades\Hash;

class ClientModel extends Model{

	protected $table = 'info_user_consumer';
	protected $primaryKey = 'id_info_user_consumer';
	public $timestamps = false;
	protected $guarded = array();


	//Function to verify the user login
	public function login($data){

		$email = $data->email;

		$pass = $data->password;

		$check = Self::where('email', $email)
						//->where('password', $pass)
						->first();

		if($check){
			if(Hash::check($pass, $check->password)){

				return $check;
			}
		}					
		
		return false; //when the user info is incorrect

	}

	public function newUser($data){

		try {

			$user= Self::create($data->all());

			return $user;


		}

		catch(QueryException $e){

			return $user;
		} 

		catch (PDOException $e) {
			
			return $user;
		}

	}

	public function getProfile($id_user){

		$user = Self::find($id_user);

		return $user;

	}

	public function updateUser(){

	}


	public function checkEmail($email){

		$verify = Self::where('email', $email)
						->get();
		
		return $verify;		

	}


	public function storeFCMTOKEN($id_user, $fcm_token){

		$user = Self::find($id_user);

		$user->fcm_token = $fcm_token;

		$user->save();

		return $user;

	}

	public function getFCMTOKEN($id_user){

		$client_fcm_token = Self::where('id_info_user_consumer', $id_user)
								->select('fcm_token')
								->first();

		return $client_fcm_token;

	}

}