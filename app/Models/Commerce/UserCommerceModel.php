<?php 
namespace App\Models\Commerce;

use Illuminate\Database\Eloquent\Model;

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
		return false;
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


		$staff = Self::create($data->all());

		return $staff;

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
						->where('id_rol_commerce', 2)
						->get();

		return $drivers;
	}
}