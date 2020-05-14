<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
	protected $table = "orders";
    public $primaryKey = "id";

    public function scopeActive($query) {
    	return $query->where('is_active', 1);
    }

    public function scopeRefunded($query) {
    	return $query->where('is_active', 0);
    }

    public function product() {
    	return $this->belongsTo('App\Product', 'product_id', 'id');
    }

}
