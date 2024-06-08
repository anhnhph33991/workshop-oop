@php use LuxChill\Models\Category; @endphp
@php

    $category = new Category();
    $categories = $category->getAll('*');

@endphp

<div class="main_nav Sticky">
    <div class="container">
        <div class="row small-gutters">
            <div class="col-xl-3 col-lg-3 col-md-3">
                <nav class="categories">
                    <ul class="clearfix">
                        <li>
                            <span>
                                <a href="#">
                                    <span class="hamburger hamburger--spin">
                                        <span class="hamburger-box">
                                            <span class="hamburger-inner"></span>
                                        </span>
                                    </span>
                                    Categories
                                </a>
                            </span>
                            <div id="menu">
                                <ul>
                                    @foreach($categories as $c)
                                        <li>
                                            <span>
                                                <a href="{{ routeClient('shops?c=' . $c['slug'] . '&id=' . $c['id']) }}">{{ $c['name'] }}</a>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
                <div class="custom-search-input">
                    <input type="text" placeholder="Tìm kiếm hàng triệu sản phẩm ">
                    <button type="submit"><i class="header-icon_search_custom"></i></button>
                </div>
            </div>
            <div class="col-xl-3 col-lg-2 col-md-3">
                <ul class="top_tools">
                    <li>
                        <div class="dropdown dropdown-cart">
                            <a href="{{ routeClient('cart') }}" class="cart_bt">
                                <strong>2</strong>
                            </a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li>
                                        <a href="product-detail-1.html">
                                            <figure>
                                                <img src="img/products/product_placeholder_square_small.jpg"
                                                     data-src="img/products/shoes/thumb/1.jpg" alt="" width="50"
                                                     height="50" class="lazy">
                                            </figure>
                                            <strong><span>1x Armor Air x Fear</span>$90.00</strong>
                                        </a>
                                        <a href="#0" class="action"><i class="ti-trash"></i></a>
                                    </li>
                                    <li>
                                        <a href="product-detail-1.html">
                                            <figure><img src="img/products/product_placeholder_square_small.jpg"
                                                         data-src="img/products/shoes/thumb/2.jpg" alt="" width="50"
                                                         height="50" class="lazy"></figure>
                                            <strong><span>1x Armor Okwahn II</span>$110.00</strong>
                                        </a>
                                        <a href="0" class="action"><i class="ti-trash"></i></a>
                                    </li>
                                </ul>
                                <div class="total_drop">
                                    <div class="clearfix"><strong>Total</strong><span>$200.00</span></div>
                                    <a href="{{ routeClient('cart') }}" class="btn_1 outline">View Cart</a>
                                    <a href="{{ routeClient('check-out') }}" class="btn_1">Checkout</a>
                                </div>
                            </div>
                        </div>
                        <!-- /dropdown-cart-->
                    </li>
                    <li>
                        <a href="#0" class="wishlist"><span>Wishlist</span></a>
                    </li>
                    <li>
                        <div class="dropdown dropdown-access">
                            <a href="{{ routeClient(active_account()) }}" class="access_link">
                                <span>Account</span>
                            </a>
                            <div class="dropdown-menu">

                                @if (!isset($_SESSION['user']))
                                    <a href="{{ routeClient('login') }}" class="btn_1">
                                        Login or Register
                                    </a>
                                @else
                                    <a href="{{ routeClient('account') }}" class="btn_1">
                                        {{ $_SESSION['user']['username'] }}
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="{{ routeClient('track-order') }}"><i class="ti-truck"></i>Track
                                                your
                                                Order</a>
                                        </li>
                                        <li>
                                            <a href="{{ routeClient('my-orders') }}"><i class="ti-package"></i>My Orders</a>
                                        </li>
                                        <li>
                                            <a href="{{ routeClient('profile') }}"><i class="ti-user"></i>My Profile</a>
                                        </li>
                                        <li>
                                            <a href="{{ routeClient('logout') }}">
                                                <i class="ri-logout-box-r-line" style="margin-top: -5px"></i>
                                                Logout
                                            </a>
                                        </li>
                                    </ul>
                                @endif

                            </div>

                        </div>
                        <!-- /dropdown-access-->
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="btn_search_mob"><span>Search</span></a>
                    </li>
                    <li>
                        <a href="#menu" class="btn_cat_mob">
                            <div class="hamburger hamburger--spin" id="hamburger">
                                <div class="hamburger-box">
                                    <div class="hamburger-inner"></div>
                                </div>
                            </div>
                            Categories
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <div class="search_mob_wp">
        <input type="text" class="form-control" placeholder="Search over 10.000 products">
        <input type="submit" class="btn_1 full-width" value="Search">
    </div>
    <!-- /search_mobile -->
</div>