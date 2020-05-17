<?php

namespace App\Http\Controllers;

use App\Product;
use App\Order;

use App\Helpers\StripeHelper;

use Illuminate\Http\Request;

class ProductsController extends Controller
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
		$product = new Product;
		$product->title = $data->title;
		$product->description = $data->description;
		$product->price = $data->price;

		$cover_image = $data->file('cover_image');
		$cover_image_name = str_replace(' ', '_', $data->file('cover_image')->getClientOriginalName());
		$data->file('cover_image')->move(public_path('images'), $cover_image_name);
		$product->cover_image = '/images/' . $cover_image_name;

		$file = $data->file('file');
		$file_name = str_replace(' ', '_', $data->file('file')->getClientOriginalName());
		$data->file('file')->move(public_path('files'), $file_name);
		$product->file = '/files/' . $file_name;

		$product->save();

		return response()->json([
			'success' => true,
			'product' => $product->toArray()
		], 200);
	}

	public function read() {
		if (isset($_GET['product_id'])) {
			return response()->json([
				'success' => true,
				'product' => Product::find($_GET['product_id'])->toArray()
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'Please specify an product id.'
			], 200);
		}
	}

	public function update(Request $data) {
		$product = Product::find($data->product_id);

		if (isset($data->title)) {
			$product->title = $data->title;
		}

		if (isset($data->description)) {
			$product->description = $data->description;
		}

		if (isset($data->cover_image)) {
			$product->cover_image = $data->cover_image;
		}

		if (isset($data->price)) {
			$product->price = $data->price;
		}

		if (isset($data->file)) {
			$product->file = $data->file;
		}

		$product->save();

		return response()->json([
			'success' => true,
			'product' => $product->toArray()
		], 200);
	}

	public function delete(Request $data) {
		$product = Product::find($data->product_id);
		$product->is_active = 0;
		$product->save();

		return response()->json([
			'success' => true
		], 200);
	}

	/* --------------------- *\
	|  2. Get Functions       |
	\* --------------------- */

	public function get() {
		return response()->json([
			'success' => true,
			'products' => Product::active()->get()->toArray()
		], 200);
	}

	/* --------------------- *\
	|  3. View Functions      |
	\* --------------------- */

	public function view_product($product_id) {
		$product = Product::find($product_id);
		return view('guest.view-product')->with('header', $product->title)->with('product', $product);
	}

	public function admin_view() {
		return view('admin.products.view')->with('header', 'Your Products');
	}

	/* --------------------- *\
	|  4. Helper Functions    |
	\* --------------------- */

	public function pay(Request $data) {
		$product = Product::find($data->product_id);

		$stripe_data = array();
		$stripe_data["cardNumber"] = $data->cardNumber;
		$stripe_data["cvvNumber"] = $data->cvvNumber;
		$stripe_data["ccExpiryMonth"] = $data->ccExpiryMonth;
		$stripe_data["ccExpiryYear"] = $data->ccExpiryYear;
		$stripe_data["email"] = $data->email;
		$stripe_data["amount"] = $product->price;
		$stripe_data["description"] = $product->description;

		$return_data = StripeHelper::checkout($stripe_data);

		if ($return_data != "error") {
			$order = new Order;
			$order->product_id = $product->id;
			$order->customer_id = $return_data["customer_id"];
			$order->charge_id = $return_data["charge_id"];
			$order->amount = $product->price;
			$order->is_guest = 1;
			$order->save();

			return response()->json([
				'success' => true,
				'order' => $order->toArray()
			], 200);
		} else {
			return response()->json([
				'success' => false
			], 200);
		}
	}

	public function download_product($customer_id) {
		if (Order::where('customer_id', $customer_id)->count() > 0) {
			$order = Order::where('customer_id', $customer_id)->first();
			$product = Product::find($order->product_id);
			return view('guest.download')->with('header', 'Thank You')->with('product', $product)->with('order', $order);
		} else {
			return redirect(url('/shop'));
		}
	}

	public function download($customer_id) {
		if (Order::where('customer_id', $customer_id)->count() > 0) {
			$order = Order::where('customer_id', $customer_id)->first();
			$product = Product::find($order->product_id);
			return response()->download(public_path($product->file));
		} else {
			return redirect(url('/shop'));
		}
	}

}
