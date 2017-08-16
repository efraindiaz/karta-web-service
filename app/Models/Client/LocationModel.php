<?php
namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use PDOException;


class LocationModel extends Model{
	

	protected $table = 'consumer_address';
	protected $primaryKey = 'id_consumer_address';
	protected $fk_user = 'id_info_user_consumer';
	public $timestamps = false;
	protected $guarded = array();


	public function newLocation($id_user, $data){		

		try {

			$location = Self::create($data->all());
			return true;
			
		} catch(QueryException $e){

			return false;
		} 
		catch (PDOException $e) {
			
			return false;
		}
	}

	public function getLocations($id_user){

		$locations = Self::where($this->fk_user, $id_user)->get();

		return $locations;
	}

	public function detailLocation($id_location){
			$location = Self::where('id_consumer_address', $id_location)->first();
			return $location;
	}

	public function updateLocation($data, $id_client, $id_location){

		try {

			$location = Self::find($id_location);
			$input = $data->all();
			$location->fill($input);
			$location->save();

			return true;
			
		}catch(QueryException $e){

			return false;
		} 
		catch (PDOException $e) {
			
			return false;
		}

		


	}

	public function deleteLocation($id_client, $id_location){

		try {

			$location = Self::find($id_location);
			$location->delete();
			return true;	
			
		} 
		catch(QueryException $e){

			return false;
		} 
		catch (PDOException $e) {
			
			return false;
		}


		
	}

}