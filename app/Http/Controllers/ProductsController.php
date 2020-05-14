<?php

namespace App\Http\Controllers;

use App\Product;

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
		$product->cover_image = $data->cover_image;
		$product->price = $data->price;
		$product->file = $data->file;
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

	public function admin_view() {
		return view('admin.products.view')->with('header', 'Your Products');
	}

	/* --------------------- *\
	|  4. Helper Functions    |
	\* --------------------- */

}
