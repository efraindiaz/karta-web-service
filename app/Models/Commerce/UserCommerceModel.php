<?php 
namespace App\Models\Commerce;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use PDOException;
use Illuminate\Support\Facades\Hash;

class UserCommerceModel extends Model
{
	protected $table = 'info_user_commerce';
	protected $primaryKey = 'id_info_user_commerce';
	//protected $hidden = array('token');	
	public $timestamps = false;
	protected $guarded = array();

	//protected $guarded = ['id'];
	//public $timestamps = false;
	//protected $fillable = ['nombre', 'direccion', 'telefono', 'carrera'];


	/*Login para colaboradores del comercio*/

	public function login($data){

		$email = $data->email;

		$pass = $data->password;

		$check = Self::where('email', $email)
						->first();

		if($check){
			if(Hash::check($pass, $check->password)){

				return $check;
			}
		}					
		
		return false; //when the user info is incorrect
	}


	//Buscando al manager de un comercio

	public function getManager($id_commerce){

		$manager = Self::where('id_commerce', $id_commerce)
						->where('id_rol_commerce', '1')
						->get();

		return $manager;
	}

	public function getAllStaff($id_commerce){

		$staff = Self::where('id_commerce', $id_commerce)
						->get();

		return $staff;

	}

	public function getStaffDetail($id_commerce, $id_staff){

		$staff = Self::where('id_info_user_commerce', $id_staff)
						->where('id_commerce', $id_commerce)
						->get();
		return $staff;
	}

	public function createManager(){
		return 'hola mundo desde FINuuuuuuuuD';
	}

	public function newStaff($id_commerce, $data){		

		try {

			$staff = Self::create($data->all());

			return $staff;


		}

		catch(QueryException $e){

			return $staff;
		} 

		catch (PDOException $e) {
			
			return $staff;
		}

	}

	//modificar manager o staff
	public function updateStaff($id_staff, $data){

		$staff = Self::find($id_staff);

		$input = $data->all();
		$staff->fill($input);
		$staff->save();
		return $staff;		
	}

	public function deleteStaff($id_commerce, $id_staff){

		$staff = Self::find($id_staff);

		if($staff){
			$staff->delete();
			return 'exito';	
		}

		return 'error';
	}

	//obtiene todos los repartidores de un comercio

	public function getDrivers($id_commerce){

		$drivers = Self::where('id_commerce', $id_commerce)
						->where('id_rol_commerce', 3)
						->get();

		return $drivers;
	}

	public function storeFCMTOKEN($id_staff, $fcm_token){

		$staff = Self::find($id_staff);

		$staff->fcm_token = $fcm_token;

		$staff->save();

		return $staff;

	}

	public function checkEmail($email){

		$verify = Self::where('email', $email)
						->get();
		
		return $verify;		

	}
}