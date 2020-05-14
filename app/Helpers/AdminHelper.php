<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class AdminHelper {
	public static function isAdmin() {
		if (Session::has('admin_id')) {
			return true;
		} else {
			return false;
		}
	}
}

?>