<?php

namespace App\Models\Platform;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model{


	protected $table = 'auth_karta_control';
	protected $primaryKey = 'id_karta';
	public $timestamps = false;


	public function login($data){


		$email = $data->email;
		$pass = $data->password;

		$check = Self::where('email', $email)
						->where('password', $pass)
						->get();

		if(count($check) > 0){

			return $check;
		}
		
		//return empty when the user info is incorrect
		return $check;

	}


}