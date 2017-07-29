<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

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
						->where('password', $pass)
						->get();
		if(count($check) > 0){

			return $check;
		}

		//return false when the user info is incorrect
		return $check;

	}

	public function newUser($data){

		$user= Self::create($data->all());

		return $user;

	}

	public function getProfile($id_user){

		$user = Self::find($id_user);

		return $user;

	}

	public function updateUser(){

	}

}