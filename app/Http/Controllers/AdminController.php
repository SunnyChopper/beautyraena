<?php

namespace App\Http\Controllers;

use Auth;

use App\User;
use App\Order;
use App\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
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

	/* --------------------- *\
	|  2. Get Functions       |
	\* --------------------- */

	/* --------------------- *\
	|  3. View Functions      |
	\* --------------------- */

	public function dashboard() {
		if (Auth::guest()) {
			return redirect(url('/admin'));
		}

		$users = User::active()->orderBy('created_at', 'DESC')->take(3)->get();
		$products = Product::active()->orderBy('created_at', 'DESC')->take(3)->get();
		$orders = Order::active()->orderBy('created_at', 'DESC')->take(3)->get();

		return view('admin.dashboard')->with('header', 'Admin Dashboard')->with('orders', $orders)->with('products', $products)->with('users', $users);
	}

	public function admin_register() {
		if (isset($_GET['pass'])) {
			if ($_GET['pass'] == 'ngtrv6') {
				return view('admin.register')->with('header', 'Admin Register');
			} else {
				return redirect(url('/'));
			}
		} else {
			return redirect(url('/'));
		}
	}

	public function admin_login() {
		return view('admin.login')->with('header', 'Admin Login');
	}

	/* --------------------- *\
	|  4. Helper Functions    |
	\* --------------------- */

	public function register(Request $data) {
		if (User::where('email', $data->email)->active()->count() == 0) {
			$user = new User;
			$user->first_name = $data->first_name;
			$user->last_name = $data->last_name;
			$user->email = $data->email;
			$user->password = Hash::make($data->password);
			$user->is_admin = 1;
			$user->save();

			Auth::login($user);

			Session::put('admin_id', $user->id);
			Session::save();

			return redirect(url('/admin/dashboard'));
		} else {
			return redirect()->back()->with('Account already associated with email.');
		}
	}

	public function login(Request $data) {
		if (User::where('email', $data->email)->active()->count() > 0) {
			$user = User::where('email', $data->email)->active()->first();
			if (Hash::check($data->password, $user->password)) {
				Auth::login($user);

				Session::put('admin_id', $user->id);
				Session::save();

				return redirect(url('/admin/dashboard'));
			} else {
				return redirect()->back()->with('error', 'Password is incorrect.');
			}
		} else {
			return redirect()->back()->with('error', 'Email not associated with any account.');
		}
	}

	public function logout() {
		Session::forget('admin_id');
		Session::save();

		return redirect(url('/'));
	}

}
