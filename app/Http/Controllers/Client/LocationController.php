<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client\LocationModel;

class LocationController extends Controller{

	function __construct(){

		$this->location = new LocationModel();
	}



	/*Listado de todas las ubicaciones del usuario*/
	public function index($id_user){

		$locations = $this->location->getLocations($id_user);

		if($locations && !$locations->isEmpty()){

			return $this->successResponse($locations, 200);
		}

		return $this->errorResponse($locations, 404);

	}

	public function detail($id_user, $id_location){
		
	}

	/*Nueva ubicacion*/
	public function create(Request $request, $id_user){

		$newLocation = $this->location->newLocation($id_user, $request);

		if(!$newLocation){
			return $this->errorResponse($newLocation, 400);
		}

		return $this->successResponse($newLocation, 200);
		
	}

	public function update(Request $request, $id_client, $id_location){

			$location = $this->location->updateLocation($request, $id_client, $id_location);

			if(!$location){

				return $this->errorResponse($location, 400);
			}

			return $this->successResponse($location, 200);
	}


	public function delete($id_client, $id_location){

		$location = $this->location->deleteLocation($id_client, $id_location);

		if(!$location){
			return $this->errorResponse($location, 400);
		}

		return $this->successResponse($location, 200);

	}


}