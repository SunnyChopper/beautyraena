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

	public function download($product_id) {
		$product = Product::find($product_id);
		return response()->download(public_path($product->file));
	}

}
