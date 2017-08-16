<?php

namespace App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use PDOException;

class OrderDetailModel extends Model{


	protected $table = 'order_detail';
	protected $primaryKey = 'id_order_detail';
	public $timestamps = false;
	protected $guarded = array();


	public function orderDetail($id_order){

		/*
		SELECT order_consumer.id_order_consumer, order_detail.id_order_detail, product.name, product.price, product.image 
		FROM `order_detail` 
		INNER JOIN order_consumer on order_detail.id_order_consumer = order_consumer.id_order_consumer
		INNER JOIN product ON order_detail.id_product = product.id_product
		WHERE order_consumer.id_order_consumer = id_user
		*/

		//id_order_consumer
		//id_order_detail
		//name
		//price
		//image

		$order = Self::join('order_consumer', 'order_detail.id_order_consumer', '=', 'order_consumer.id_order_consumer')
					->join('product', 'order_detail.id_product', '=', 'product.id_product')
					->select('order_consumer.id_order_consumer', 'order_detail.id_order_detail', 'product.name', 'product.price', 'product.image')
					->where('order_consumer.id_order_consumer', $id_order)
					->get();

		return $order;


	}	

}