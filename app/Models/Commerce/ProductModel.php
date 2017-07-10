<?php

namespace App\Models\Commerce;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model{

	protected $table = 'product';
	protected $primaryKey = 'id_product';
	public $timestamps = false;
	protected $guarded = array();


	public function getAllProducts($id_commerce){

		$products = Self::where('id_commerce', $id_commerce)
							->get();

		return $products;

	}

	public function detailProduct($id_commerce, $id_product){

		//Validacion para saber si existe el comercio
			//$product = $this->checkCommerce($id_commerce);
		//Validacion para saber si existe el producto

		$product = Self::find($id_product);

		return $product;

	}

	public function newProduct($id_commerce, $data){

		$product = Self::create($data->all());

		return $product;
	}

	public function updateProduct($id_commerce, $id_product, $data){

		$product = Self::find($id_product);
		$input = $data->all();
		$product->fill($input);

		$product->save();

		return $product;

	}

	public function deleteProduct($id_commerce, $id_product){
		$product = Self::find($id_product);
		$product->delete();
	}


	//Validators

	//Commerce validator
	public function checkCommerce($id_commerce){


		return 'aqui entra para validar comercio';
	}

	//Product validator
	public function checkProduct($id_product){


	}

}