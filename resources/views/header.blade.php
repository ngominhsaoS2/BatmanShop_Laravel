<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href=""><i class="fa fa-home"></i> 90-92 Lê Thị Riêng, Bến Thành, Quận 1</a></li>
                    <li><a href=""><i class="fa fa-phone"></i> 0163 296 7751</a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">
                    @if(Auth::check())
                        <li><a href="#"><i class="fa fa-user"></i>{{Auth::user()->full_name}}</a></li>
                        <li><a href="{{route('Logout')}}">Đăng xuất</a></li>
                    @else
                        <li><a href="{{route('SignUp')}}">Đăng kí</a></li>
                        <li><a href="{{route('Login')}}">Đăng nhập</a></li>
                    @endif
                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="index.html" id="logo"><img src="source/assets/dest/images/logo-cake.png" width="200px" alt=""></a>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="{{route('Search')}}">
                        <input type="text" value="" name="key" id="search" placeholder="Nhập từ khóa..." />
                        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                    </form>
                </div>

                <div class="beta-comp">
                    <div class="cart">
                        <div class="beta-select">
                            <i class="fa fa-shopping-cart"></i>
                                @if(Session::has('cart'))
                                    Giỏ hàng ({{Session('cart')->totalQuantity}})
                                @else
                                    Giỏ hàng (trống)
                                @endif
                            <i class="fa fa-chevron-down"></i>
                        </div>
                        @if(Session::has('cart'))
                            <div class="beta-dropdown cart-body">
                                @foreach($product_cart as $item)
                                    <div class="cart-item">
                                        <a class="cart-item-delete" href="{{route('DeleteCartItem', $item['item']['id'])}}"><i class="fa fa-times"></i></a>
                                        <div class="media">
                                            <a class="pull-left" href="#"><img src="source/image/product/{{$item['item']['image']}}" alt="{{$item['item']['name']}}"></a>
                                            <div class="media-body">
                                                <span class="cart-item-title">{{$item['item']['name']}}</span>
                                                <span class="cart-item-amount">{{$item['quantity']}} * 
                                                    <span>
                                                        @if($item['item']['promotion_price'] == 0)
                                                            {{number_format($item['item']['unit_price'])}}
                                                        @else
                                                            {{number_format($item['item']['promotion_price'])}}
                                                        @endif
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                
                                <div class="cart-caption">
                                    <div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">{{number_format(Session('cart')->totalPrice)}}</span></div>
                                    <div class="clearfix"></div>
                                    <div class="center">
                                        <div class="space10">&nbsp;</div>
                                        <a href="{{route('Order')}}" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div> <!-- .cart -->
                </div>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-body -->
    <div class="header-bottom" style="background-color: #0277b8;">
        <div class="container">
            <a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li><a href="{{route('Home')}}">Trang chủ</a></li>
                    <li>
                        <a href="#">Sản phẩm</a>
                        <ul class="sub-menu">
                            @foreach($listProductTypes as $item)
                                <li><a href="{{route('ProductCategory', $item->id)}}">{{$item->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="about.html">Giới thiệu</a></li>
                    <li><a href="{{route('Contact')}}">Liên hệ</a></li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div> <!-- .container -->
    </div> <!-- .header-bottom -->
</div> <!-- #header -->