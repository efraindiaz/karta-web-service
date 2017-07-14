<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client\LocationModel;

class LocationController extends Controller{

	function __construct(){

		$this->location = new LocationModel();
	}


	public function index($id_user){

		$locations = $this->location->getLocations($id_user);

		return $locations;

	}

	public function detail($id_user, $id_location){

	}

	public function create(Request $request, $id_user){

		$newLocation = $this->location->newLocation($id_user, $request);

		return $newLocation;
		
	}

	public function update(){

	}


	public function delete(){

	}


}