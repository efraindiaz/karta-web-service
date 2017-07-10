<?php

namespace App\Http\Controllers\Platform;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Platform\CommerceModel;
use App\Models\Commerce\UserCommerceModel;
use Illuminate\Support\Facades\Validator;



class CommerceController extends Controller
{

    function __construct(){

        $this->commerce = new CommerceModel;
        $this->staff = new UserCommerceModel;    
    }
    
    //Funcion para listar todos los comercios desde KARTA ADMIN
    public function index(){
        
        $listCommerce = $this->commerce->getCommerce();
        $data = ['data' => $listCommerce];
        return response()->json($data);
    }

    //Informacion detallada de un comercio
    public function detail($id_commerce){
        
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

    //modifica la informacion de un comercio
    public function update(Request $request, $id_commerce){

        
        $update = $this->commerce->updateCommerce($id_commerce, $request);        

        return $update;
    }

    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */

     /* $data = [
            'state' => $request->state,
            'city' => 'holis'
        ];

        $rules = [
            'state' => 'required' 
        ];
        $validator = Validator::make($data,$rules);

        if($validator->passes()){
            //$update = $this->commerce->updateCommerce($id_commerce, $request); 
            return 'si existe XD';
        }
        $data = (object)$data;
        */
}