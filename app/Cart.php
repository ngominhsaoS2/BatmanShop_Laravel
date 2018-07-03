<?php

namespace App;

class Cart
{
	public $items = null;
	public $totalQuantity = 0;
	public $totalPrice = 0;

	public function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart->items;
			$this->totalQuantity = $oldCart->totalQuantity;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}

	public function add($item, $id){
		//Lấy giá sản phẩm
		if($item->promotion_price > 0){
			$price = $item->promotion_price;
		}
		else{
			$price = $item->unit_price;
		}

		$cartItem = ['quantity'=>0, 'price' => $price, 'item' => $item];
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$cartItem = $this->items[$id];
			}
		}

		$cartItem['quantity']++;
		$cartItem['price'] = $price;
		$this->items[$id] = $cartItem;
		$this->totalQuantity++;
		$this->totalPrice += $cartItem['price'];
	}
	//xóa 1
	public function reduceByOne($id){
		$this->items[$id]['quantity']--;
		$this->items[$id]['price'] -= $this->items[$id]['item']['price'];
		$this->totalQuantity--;
		$this->totalPrice -= $this->items[$id]['item']['price'];
		if($this->items[$id]['quantity']<=0){
			unset($this->items[$id]);
		}
	}
	//xóa nhiều
	public function removeItem($id){
		$this->totalQuantity -= $this->items[$id]['quantity'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
}
