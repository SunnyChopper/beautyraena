<?php

namespace App\Http\Controllers;

use App\Product;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    
	public function index() {
		$products = Product::active()->get();

		return view('guest.index')->with('products', $products);
	}

}
