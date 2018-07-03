<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model {
	protected $table = "bill_detail";

	public function Product() {
		return $this->belongsTo('App\Product', 'id_product', 'id');
	}

	public function Bill() {
		return $this->belongsTo('App\Bill', 'id_bill', 'id');
	}
}