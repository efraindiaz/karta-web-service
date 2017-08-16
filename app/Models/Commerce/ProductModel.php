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
							->orderBy('id_product', 'DESC')
							->get();

		return $products;

	}

	public function catFilter($id_commerce, $id_cat){

		$products = Self::where('id_commerce', $id_commerce)
						->where('id_product_type', $id_cat)
						->get();

		return $products;

	}

	public function detailProduct($id_commerce, $id_product){

		//Validacion para saber si existe el comercio
			//$product = $this->checkCommerce($id_commerce);
		//Validacion para saber si existe el producto

		$product = Self::where('id_product', $id_product)
						->get();

		return $product;

	}

	public function newProduct($id_commerce, $data){

		$product = new Self;

		$product->id_commerce = $data->id_commerce;
		$product->name = $data->name;
		$product->price = $data->price;
		$product->description = $data->description;
		$product->id_product_type = $data->id_product_type;
		$product->image = $data->image;

		$product->save();

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