<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Slide;
use App\Product;
use App\ProductType;
use App\Cart;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\User;
use Hash;
use Session;
use Auth;

class PageController extends Controller {
	//
	public function getHome() {
		$listSlides = Slide::all();
		$listNewProducts = Product::where('new', 1)->paginate(4);
		$listTopProducts = Product::where('promotion_price', '<>', 0)->paginate(8);
		return view('page.home', compact('listSlides', 'listNewProducts', 'listTopProducts'));
		// print_r($listSlides);
		// exit;
		// return view('page.home', ['listSlides' => $listSlides]);
	}

	public function getProductCategory($id) {
		$listProducts = Product::where('id_type', $id)->get();
		$otherProducts = Product::where('id_type', '<>', $id)->paginate(3);
		$listProductTypes = ProductType::all();
		$productType = ProductType::where('id', $id)->first();
		return view('page.product_category', compact('listProducts', 'otherProducts', 'listProductTypes', 'productType'));
	}

	public function getProduct(Request $request) {
		$product = Product::where('id', $request->id)->first();
		$listRelatedProducts = Product::where('id_type', $product->id_type)->paginate(6);
		return view('page.product', compact('product', 'listRelatedProducts'));
	}

	public function getContact() {
		return view('page.contact');
	}

	public function getAddToCart(Request $req, $id) {
		$product = Product::find($id);
		$oldCart = Session('cart') ? Session::get('cart') : null;
		$cart = new Cart($oldCart);
		$cart->add($product, $id);
		$req->session()->put('cart', $cart);
		return redirect()->back();
	}

	public function getDeleteCartItem($id) {
		$oldCart = Session::has('cart') ? Session::get('cart') : null;
		$cart = new Cart($oldCart);
		$cart->removeItem($id);
		if(count($cart->items) > 0){
			Session::put('cart', $cart);
		}
		else{
			Session::forget('cart');
		}
		
		return redirect()->back();
	}

	public function getOrder() {
		$oldCart = Session::has('cart') ? Session::get('cart') : null;
		$cart = new Cart($oldCart);
		return view('page.order', ['product_cart' => $cart->items, 'cart' => $cart,
			'totalPrice' => $cart->totalPrice, 'totalQuantity' => $cart->totalQuantity]);
	}

	public function postOrder(Request $req) {
		$cart = Session::get('cart');
		
		//Insert vào bảng Customer
		$customer = new Customer;
		$customer->name = $req->name;
		$customer->gender = $req->gender;
		$customer->email = $req->email;
		$customer->address = $req->address;
		$customer->phone_number = $req->phone_number;
		$customer->note = $req->note;
		$customer->save();

		//Insert vào bảng Bill
		$bill = new Bill;
		$bill->id_customer = $customer->id;
		$bill->date_order = date('Y-m-d');
		$bill->total = $cart->totalPrice;
		$bill->payment = $req->payment_method;
		$bill->note = $req->note;
		$bill->save();

		//Insert vào bảng BillDetail
		foreach($cart->items as $item) {
			$billDetail = new BillDetail;
			$billDetail->id_bill = $bill->id;
			$billDetail->id_product = $item['item']['id'];
			$billDetail->quantity = $item['quantity'];
			$billDetail->unit_price = $item['price'];
			$billDetail->save();
		}

		//Xóa session cart
		Session::forget('cart');
		return redirect()->back()->with('thongbao', 'Đặt hàng thành công !');
	}

	public function getLogin() {
		return view('page.login');
	}

	public function postLogin(Request $req) {
		$this->validate($req,
			[
				'email' => 'required|email',
				'password' => 'required',
			],
			[
				'email.required' => 'Vui lòng nhập email',
				'email.email' => 'Không đúng định dạng email',
				'password.required' => 'Vui lòng nhập mật khẩu',
			]
		);

		$credentials = array('email' => $req->email, 'password' => $req->password);
		if(Auth::attempt($credentials )){
			return redirect('Home');
		}
		else{
			return redirect()->back()->with('thongbao', 'Bạn đã nhập sai email hoặc mật khẩu !');
		}

	}

	public function getLogout() {
		Auth::logout();
		return redirect()->route('Home');
	}

	public function getSignUp() {
		return view('page.sign_up');
	}

	public function postSignUp(Request $req) {
		$this->validate($req,
			[
				'email' => 'required|email|unique:users,email',
				'password' => 'required|min:3|max:20',
				'fullName' => 'required',
				'rePassword' => 'required|same:password'
			],
			[
				'email.required' => 'Vui lòng nhập email',
				'email.email' => 'Không đúng định dạng email',
				'email.unique' => 'Email đã được sử dụng',
				'password.required' => 'Vui lòng nhập mật khẩu',
				'password.min' => 'Mật khẩu có tối thiểu 3 kí tự',
				'password.max' => 'Mật khẩu có tối đa 20 kí tự',
				'fullName.required' => 'Vui lòng nhập tên',
				'rePassword.required' => 'Vui lòng nhập lại mật khẩu',
				'rePassword.same' => 'Mật khẩu nhập lại không khớp'
			]
		);
		
		$user = new User;
		$user->full_name = $req->fullName;
		$user->email = $req->email;
		$user->password = Hash::make($req->password);
		$user->phone = $req->phone;
		$user->address = $req->address;
		$user->save();
		return redirect()->back()->with('thanhcong', 'Đăng kí thành công !');
	}

	public function getSearch(Request $req) {
		$key = $req->key;
		$listFoundProducts = Product::where('name', 'like', '%'.$req->key.'%')
							  ->orWhere('description', 'like', '%'.$req->key.'%')
							  ->paginate(8);

		return view('page.search', compact('listFoundProducts', 'key'));
	}

}
