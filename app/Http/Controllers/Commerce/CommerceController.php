<?php

namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Platform\CommerceModel;
use App\Models\Commerce\UserCommerceModel;
use App\Models\Commerce\ProductModel;
use App\Models\Client\ClientModel;
use Illuminate\Support\Facades\Validator;


class CommerceController extends Controller{


	function __construct(){

        $this->commerce = new CommerceModel;
        $this->staff = new UserCommerceModel;
        $this->product = new ProductModel; 
        $this->client = new ClientModel;   
    }


	public function index($id_commerce){

		//$manager = $this->staff->getManager($id_commerce);
        $detail = $this->commerce->detailCommerce($id_commerce);

        /*$data = [

                'manager' => $manager,
                'commerce' => $detail
        ];*/

        if($detail->isEmpty()){

            return $this->errorResponse('not found', 404);
        }

        
        return $this->successResponse($detail,200);
	}


	public function update(Request $request, $id_commerce){

        
        $update = $this->commerce->updateCommerce($id_commerce, $request);        

        return $update;
    }

    public function freeCommerces(){

        $pCommerce = $this->commerce->getAllPublicCommerces();
        return $this->successResponse($pCommerce, 200);
    }

    public function freeCommerceDetail($id_commerce){

        $pCommerce = $this->commerce->getPublicCommerce($id_commerce);
        return $this->successResponse($pCommerce, 200);

    }

    public function fullCommerce($id_commerce){

        $full_commerce = $this->commerce->getPublicCommerce($id_commerce);

        if($full_commerce && !$full_commerce->isEmpty()){

            $full_commerce[0]['cat1'] = $this->product->catFilter($id_commerce, 1);
            $full_commerce[0]['cat2'] = $this->product->catFilter($id_commerce, 2);
            $full_commerce[0]['cat3'] = $this->product->catFilter($id_commerce, 3);
            $full_commerce[0]['cat4'] = $this->product->catFilter($id_commerce, 4);

            return $this->successResponse($full_commerce, 200);    
        }

        return $this->errorResponse($full_commerce, 401);

        
    }


    /*PUSH NOTIFICATION SECTION*/

    //SEND NOTIFICATION TO DELIVERY MAN

    public function fcm_staff($id_staff){

    }


    //http://localhost:8000/api/commerce/push_notification/to_client/{id_client}/{reason}
    //SEND NOTIFICATION TO CLIENT

    public function fcm_client($id_client, $reason){

        
        //first we need to search the fcm_token from the $id_client

        $client_fcm_token = $this->client->getFCMTOKEN($id_client);

        if($client_fcm_token['fcm_token'] == null){
            return $this->errorResponse($reason, 404);
        }
        else{

            //$reason only receive a value 1 or 2

            //we need to know what is the notification subject

            //1 when the status order is chanched

            if($reason == 1){
                return 'notification for status changed';
            }

            //2 when the order is arriving to home

            if($reason == 2){
                $token = $client_fcm_token['fcm_token'];
                $message = '¡Su pedido ya esta aquí!';
                $message_status = $this->send_notification($token, $message);

                if($message_status){

                    return $this->successResponse($message_status, 200);

                }

                return $this->errorResponse($message_status, 400);
            }
        }



    }


    //Send generic notification function to FCM
    public function send_notification($token, $message){

        $url = 'https://fcm.googleapis.com/fcm/send';

        $header = array(
            'Authorization:key = AAAA7m_Uwrw:APA91bHY8r_KrkCiT-gCDC_3PC_bJeAUTrJYzlfVve2sKPepTQM7fCbC1SzumSevTs-JxPPaHi9JKWCMWjAK9opAuXWZcAdAMhptkr6y0CVzbOruneig6gsVg6YkDJSEnfuwhhIdllmW',
            'Content-Type:application/json'
            );
        //Create a new message
        $notification = array('title'=> 'Nombre del Comercio', 'body' => $message);

        //Add the fields to notification
        $fields = array('to' => $token, 'notification'=> $notification);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch); 

        if ($result === FALSE) {
           die('Curl failed: ' . curl_error($ch));
           }
           curl_close($ch);
           return $result;
    }

}