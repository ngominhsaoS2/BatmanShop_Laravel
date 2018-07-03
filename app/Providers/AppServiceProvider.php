<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ProductType;
use App\Cart;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('header', function($view){
            //Lấy ra danh sách ProductTypes để đẩy vào menu Sản phẩm
            $listProductTypes = ProductType::all();
            $view->with(['listProductTypes' => $listProductTypes]);
        });

        view()->composer('header', function($view){
            //Lấy ra session cart
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);

                $view->with(['cart' => Session::get('cart'),
                'product_cart' => $cart->items, 'totalPrice' => $cart->totalPrice,
                'totalQuantity' => $cart->totalQuantity]);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
