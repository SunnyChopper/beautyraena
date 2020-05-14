<?php

namespace App\Http\Controllers;

use App\Order;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    
	/* ---------------------------- *\
	|  Feature Controller            |
	|--------------------------------|
	|  1. CRUD Functions             |
	|  2. Get Functions              |
	|  3. View Functions             |
	|  4. Helper Functions           |
	\* ---------------------------- */

	/* --------------------- *\
	|  1. CRUD Functions      |
	\* --------------------- */

	public function create(Request $data) {
		$order = new Order;
		$order->product_id = $data->product_id;
		$order->customer_id = $data->customer_id;
		$order->charge_id = $data->charge_id;
		$order->amount = $data->amount;
		$order->is_guest = $data->is_guest;

		if ($data->is_guest = 0) {
			$order->user_id = $data->user_id;
		}

		$order->save();

		return response()->json([
			'success' => true,
			'order' => $order->toArray()
		], 200);
	}

	public function read() {
		if (isset($_GET['order_id'])) {
			return response()->json([
				'success' => true,
				'order' => Order::find($_GET['order_id'])->toArray()
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'Please specify an order id.'
			], 200);
		}
	}

	/* --------------------- *\
	|  2. Get Functions       |
	\* --------------------- */

	public function get() {
		if (isset($_GET['user_id'])) {
			return response()->json([
				'success' => true,
				'orders' => Order::where('user_id', $_GET['user_id'])->active()->get()->toArray()
			], 200);
		} else {
			return response()->json([
				'success' => true,
				'orders' => Order::active()->get()->toArray()
			], 200);
		}
	}

	/* --------------------- *\
	|  3. View Functions      |
	\* --------------------- */

	/* --------------------- *\
	|  4. Helper Functions    |
	\* --------------------- */
    
}
