<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model {
	protected $table = "bills";

	public function BillDetail() {
		return $this->hasMany('App\BillDetail', 'id_bill', 'id');
	}

	public function Customer() {
		return $this->belongsTo('App\Customer', 'id_customer', 'id');
	}
}
