<?php 
namespace App\Models\Platform;

use Illuminate\Database\Eloquent\Model;

class CommerceModel extends Model
{
	protected $table = 'commerce';
	protected $primaryKey = 'id_commerce';
	public $timestamps = false;
	protected $guarded = array();
	//protected $fillable = ['nombre', 'direccion', 'telefono', 'carrera'];

	//Lista todos los comercios
	public function getCommerce()
	{	
		$commerce = Self::all();
		return $commerce;
	}

	public function createCommerce(){
		return 'hola mundo desde FINuuuuuuuuD';
	}


	//Detalle comercio
	public function detailCommerce($id){

		$detailCommerce = Self::where('id_commerce',  $id)->get();

		return $detailCommerce;

	}

	//Actualiza infotmacion de un comercio
	public function updateCommerce($id, $data){


		$commerce = Self::find($id);
		$input = $data->all();
		$commerce->fill($input);
		$commerce->save();
		 return $commerce;
	}

	//preguntale a a guayo sobre su presentacion
}