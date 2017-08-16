<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use PDOException;

class OrderConsumerModel extends Model{


	protected $table = 'order_consumer';
	protected $primaryKey = 'id_order_consumer';
	public $timestamps = false;
	protected $guarded = array();


	public function listOrders($id_user){

		//$orders = Self::where('id_info_user_consumer', $id_user)->get();

		$orders = Self::join('commerce', 'order_consumer.id_commerce', '=', 'commerce.id_commerce')
						->join('status_order', 'order_consumer.id_status_order', '=', 'status_order.id_status_order')
						->select('order_consumer.*', 'status_order.status_order', 'status_order.status_color','commerce.name')
						->where('order_consumer.id_info_user_consumer', $id_user)
						->get();
		return $orders;
	}

	public function listOrdersToCommerce($id_commerce){

		$orders = Self::join('commerce', 'order_consumer.id_commerce', '=', 'commerce.id_commerce')
						->join('info_user_consumer', 'order_consumer.id_info_user_consumer', '=', 'info_user_consumer.id_info_user_consumer')
						->join('status_order', 'order_consumer.id_status_order', '=', 'status_order.id_status_order')
						->join('consumer_address', 'order_consumer.id_consumer_address', '=', 'consumer_address.id_consumer_address')
						->select('order_consumer.*',
							'info_user_consumer.name AS user_name', 'info_user_consumer.last_name AS user_last_name', 
							'status_order.status_order', 
							'status_order.status_color','commerce.name',
							'consumer_address.*')							
						->where('order_consumer.id_commerce', $id_commerce)
						->get();
		return $orders;
	}

	public function listOrdersToDelivery($id_staff){

		$orders = Self::join('commerce', 'order_consumer.id_commerce', '=', 'commerce.id_commerce')
						->join('info_user_consumer', 'order_consumer.id_info_user_consumer', '=', 'info_user_consumer.id_info_user_consumer')
						->join('status_order', 'order_consumer.id_status_order', '=', 'status_order.id_status_order')
						->join('consumer_address', 'order_consumer.id_consumer_address', '=', 'consumer_address.id_consumer_address')
						->select('order_consumer.*',
							'info_user_consumer.name AS user_name', 'info_user_consumer.last_name AS user_last_name', 
							'status_order.status_order', 
							'status_order.status_color','commerce.name',
							'consumer_address.*')							
						->where('order_consumer.id_staff_delivery', $id_staff)
						->get();
		return $orders;

	}	

}