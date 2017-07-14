<?php

namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commerce\ProductModel;

class ProductController extends Controller{

	function __construct(){

        $this->product = new ProductModel;    
    }


    //Lista todos los productos de un comercio en especifico
	public function index($id_commerce){
		
		$allProducts = $this->product->getAllProducts($id_commerce);

		return $this->successResponse($allProducts,200);

		//return $allProducts;
	}

	//Detalle de producto
	public function detail($id_commerce, $id_product){

		$detailProduct = $this->product->detailProduct($id_commerce, $id_product);

		return response()->json($detailProduct);

	}

	//Crear un nuevo producto
	public function create($id_commerce, Request $request){
		
		$newProduct = $this->product->newProduct($id_commerce, $request);

		return $newProduct;


	}

	//ACtualizar un producto
	public function update($id_commerce, $id_product, Request $request){

		$updateProduct = $this->product->updateProduct($id_commerce, $id_product, $request);

		return $updateProduct;
	}

	//Borrar un producto
	public function delete($id_commerce, $id_product){

		$deleteProduct = $this->product->deleteProduct($id_commerce, $id_product);

		return $deleteProduct;

	}

}