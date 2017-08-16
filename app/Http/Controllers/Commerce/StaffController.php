<?php
namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commerce\UserCommerceModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller{

	function __construct(){

        $this->staff = new UserCommerceModel;    
    }


    //Listar todos los colaboradores de comercio en especifico
	public function index($id_commerce){


		$commerceStaff = $this->staff->getAllStaff($id_commerce);
		return $this->successResponse($commerceStaff,200);

	}

	//Detalle colaborador
	public function search($id_commerce, $id_staff){

		$staffDetail = $this->staff->getStaffDetail($id_commerce, $id_staff);

		return $staffDetail;

	}

	//Crear un nuevo colaborador
	public function create($id_commerce, Request $request){

		//Obtiene el email del request

		$email = $request->input('email');

		//Llama modelo para validar email
		$checkEmail = $this->staff->checkEmail($email);

		//Valida si el correo ya existe
		if($checkEmail && !$checkEmail->isEmpty()){

			return $this->errorResponse($request->all(), 400);

		}
		//Si no existe el correo procede a crear al nuevo usuario
		else{

			//Encripta la contraseña de usuario		
			$password = Hash::make($request->input('password'));//app('hash')->make($request->input('password'));
			//Generar un token para usuario nuevo
			$token = str_random(50);
			//Integrar password y token al request
			$secureFields = ['password' => $password, 'token' => $token];

			$request->merge($secureFields);

			//Llama modelo para crear nueva cuenta de usuario
			$createStaff = $this->staff->newStaff($id_commerce, $request);

			//Si se creo exitosamente	
			if($createStaff){

				return $this->successResponse($createStaff, 200);
			}
		}

		//Si hubo algun problema al crear usuario
		return $this->errorResponse($request->all(), 401);

	}

	//Editar Colaborador
	public function update($id_staff, Request $request){

		$updateStaff = $this->staff->updateStaff($id_staff, $request);

		return $updateStaff;

	}

	//Eliminar colaborador
	public function delete($id_commerce, $id_staff){

		$deleteStaff = $this->staff->deleteStaff($id_commerce, $id_staff);

		return $deleteStaff;
	}


	//Lista los repartidores

	public function driver($id_commerce){

		$driverList = $this->staff->getDrivers($id_commerce);

		if($driverList->isEmpty()){

			return $this->errorResponse($driverList, 404);

		}

		return $this->successResponse($driverList, 200);
	}
}