<?php

namespace App\Http\Controllers\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order\OrderConsumerModel;
use App\Models\Order\OrderDetailModel;
use App\Models\Client\LocationModel;

class OrderController extends Controller{

	function __construct(){

		$this->order = new OrderConsumerModel;
		$this->order_detail = new OrderDetailModel;
		$this->location = new LocationModel();

	}


	//Lista los pedidos de un usuario
	public function index($id_consumer){

		$items = array();

		$orders = $this->order->listOrders($id_consumer);

		if($orders && !$orders->isEmpty()){


			/*for($i = 0; $i < count($orders); $i++){
				
				$items[] = $this->order_detail->orderDetail($orders[$i]['id_order_consumer']);

				$orders[$i]['detail'] = $this->order_detail->orderDetail($orders[$i]['id_order_consumer']);

				
			}*/

			return $this->successResponse($orders,200);	
		}

		return $this->errorResponse($orders, 404);

		

	}

	//Crea un nuevo pedido para el usuario
	public function create($id_consumer){		
	}

	//Muestra el detalle de un pedido
	public function detail($id_order){

		$order = $this->order_detail->orderDetail($id_order);

		if($order && !$order->isEmpty()){

			return $this->successResponse($order, 200);
		}

		return $this->errorResponse($order, 404);

	}

	//Busca orden para repartidor

	public function delivery($id_staff){

		$orderDelivery = $this->order->listOrdersToDelivery($id_staff);

		if(!$orderDelivery->isEmpty()){

			/*for ($i=0; $i < count($orderDelivery); $i++) { 
				$orderDelivery[$i]['location'] = $this->location->detailLocation($orderDelivery[$i]['id_consumer_address']);
			}*/

			return $this->successResponse($orderDelivery, 200);
		}

		return $this->errorResponse($orderDelivery, 404);

	}

	//Busca orden para comercio

	public function orders_commerce($id_commerce){

		$ordersCommerce = $this->order->listOrdersToCommerce($id_commerce);

		if(!$ordersCommerce->isEmpty()){

			return $this->successResponse($ordersCommerce, 200);
		}

		return $this->errorResponse($ordersCommerce, 404);
	}

}