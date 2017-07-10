<?php

namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Platform\CommerceModel;
use App\Models\Commerce\UserCommerceModel;
use Illuminate\Support\Facades\Validator;


class CommerceController extends Controller{


	function __construct(){

        $this->commerce = new CommerceModel;
        $this->staff = new UserCommerceModel;    
    }


	public function index($id_commerce){

		$manager = $this->staff->getManager($id_commerce);
        $detail = $this->commerce->detailCommerce($id_commerce);

        $data = [

                'manager' => $manager,
                'commerce' => $detail
        ];

        if($manager->isEmpty() && $detail->isEmpty()){

            return $this->errorResponse('not found', 400);
        }

        
        return $this->successResponse($data,200);
	}


	public function update(Request $request, $id_commerce){

        
        $update = $this->commerce->updateCommerce($id_commerce, $request);        

        return $update;
    }





}