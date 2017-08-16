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

		if($allProducts && !$allProducts->isEmpty()){
			return $this->successResponse($allProducts,200);	
		}

		return $this->errorResponse($allProducts, 404);
	}

	//Lista producto por categoria

	public function cat_filter($id_commerce, $id_cat){


		$productsFilter = $this->product->catFilter($id_commerce, $id_cat);

		if($productsFilter && !$productsFilter->isEmpty()){

			return $this->successResponse($productsFilter, 200);
		}


		return $this->errorResponse($productsFilter, 401);

	}

	//Detalle de producto
	public function detail($id_commerce, $id_product){

		$detailProduct = $this->product->detailProduct($id_commerce, $id_product);

		if($detailProduct && !$detailProduct->isEmpty()){

			return $this->successResponse($detailProduct, 200);
		}

		return $this->errorResponse($detailProduct, 404);

	}

	//Crear un nuevo producto
	public function create($id_commerce, Request $request){
	
		
		

		//return $this->successResponse($newProduct, 200);

		if ($request->hasFile('image')) {
		    
		    $image = $request->file('image');
		    $filename  = time() . '.' . $image->getClientOriginalExtension();
		    $path = 'images/';

		    $data = $request->except('image');
		    $data['image'] = $filename;

		    $newProduct = $this->product->newProduct($id_commerce, (object)$data);

			if($newProduct){
				$image->move($path, $filename);
				return $this->successResponse($newProduct, 200);

			}
		    //$newImageName = ['image' => $filename];
		  	//$request->merge($newImageName);
		  	//$request['image'] = $filename;
		  	//$request->merge(['name' => $filename]);

 			//$image->move($path, $filename);
		    
		}
		//$request->merge(['image' => 'hola']);
		

	}

	//ACtualizar un producto
	public function update($id_commerce, $id_product, Request $request){

		if ($request->hasFile('image')){
			return 'hay imagen';
		}

		return 'hola';
		//return $request->all();
		/*return $request->all();

		if ($request->hasFile('image')) {
		    return 'si hay';
		}*/

		//$updateProduct = $this->product->updateProduct($id_commerce, $id_product, $request);

		//return $updateProduct;
	}

	//Borrar un producto
	public function delete($id_commerce, $id_product){

		$deleteProduct = $this->product->deleteProduct($id_commerce, $id_product);

		return $deleteProduct;

	}

}