<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    
	protected $table = "tickets";
    public $primaryKey = "id";

    public function scopeCompleted($query) {
    	return $query->where('status', 2);
    }

    public function scopeActive($query) {
    	return $query->where('status', 1);
    }

    public function scopeDeleted($query) {
    	return $query->where('status', 0);
    }

}
