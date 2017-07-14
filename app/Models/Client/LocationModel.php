<?php
namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;


class LocationModel extends Model{
	

	protected $table = 'consumer_address';
	protected $primaryKey = 'id_consumer_address';
	protected $fk_user = 'id_info_user_consumer';
	public $timestamps = false;
	protected $guarded = array();


	public function newLocation($id_user, $data){

		$location = Self::create($data->all());
		return $location;
	}

	public function getLocations($id_user){

		$locations = Self::where($this->fk_user, $id_user)->get();

		return $locations;
	}

	public function detailLocation(){

	}

	public function updateLocation(){

	}

	public function deleteLocation(){

	}

}