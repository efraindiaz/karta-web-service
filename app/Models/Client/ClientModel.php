<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model{

	protected $table = 'info_user_consumer';
	protected $primaryKey = 'id_info_user_consumer';
	public $timestamps = false;
	protected $guarded = array();


	public function newUser($data){

		$user= Self::create($data->all());

		return $user;

	}

	public function getProfile(){

	}

	public function updateUser(){

	}

}