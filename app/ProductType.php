<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model {
	protected $table = "type_products";

	public function Product() {
		return $this->hasMany('App\Product', 'id_type', 'id');
	}
}
