<?php
namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commerce\UserCommerceModel;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller{

	function __construct(){

        $this->staff = new UserCommerceModel;    
    }


    //Listar todos los colaboradores de comercio en especifico
	public function index($id_commerce){


		$commerceStaff = $this->staff->getAllStaff($id_commerce);
		return $commerceStaff;

	}

	//Detalle colaborador
	public function search($id_commerce, $id_staff){

		$staffDetail = $this->staff->getStaffDetail($id_commerce, $id_staff);

		return $staffDetail;

	}

	//Crear un nuevo colaborador
	public function create($id_commerce, Request $request){


		//Generar un token para colaborador nuevo
		$token = ['token' => '123456789abcdefghj'];

		$request->merge($token);

		$newStaff = $this->staff->newStaff($id_commerce, $request);

		return $newStaff;

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

}