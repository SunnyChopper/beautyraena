<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
	protected $table = "products";
    public $primaryKey = "id";

    public function scopeActive($query) {
    	return $query->where('is_active', 1);
    }

    public function scopeDeleted($query) {
    	return $query->where('is_active', 0);
    }

    public function orders() {
    	return $this->hasMany('App\Order', 'id', 'product_id');
    }

}
