@extends('layouts.master')
@section('title')
    Shops
@endsection

@section('main')
    <div class="top_banner">
        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
            <div class="container">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{ routeClient() }}">Home</a></li>
                        <li>Shops</li>
                    </ul>
                </div>
                <h1>Shoes - Grid listing</h1>
            </div>
        </div>
        <img src="{{ asset('client/img/bg_cat_shoes.jpg') }}" class="img-fluid" alt="">
    </div>
    <!-- /top_banner -->
    <div id="stick_here"></div>
    <div class="toolbox elemento_stick">
        <div class="container">
            <ul class="clearfix">
                <li>
                    <div class="sort_select">
                        <select name="sort" id="sort">
                            <option value="popularity" selected="selected">Sort by popularity</option>
                            <option value="rating">Sort by average rating</option>
                            <option value="date">Sort by newness</option>
                            <option value="price">Sort by price: low to high</option>
                            <option value="price-desc">Sort by price: high to
                        </select>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- /toolbox -->

    <div class="container margin_30">

        <div class="row">
            <aside class="col-lg-3" id="sidebar_fixed">
                <div class="filter_col">
                    <div class="inner_bt"><a href="#" class="open_filters"><i class="ti-close"></i></a></div>
                    <div class="filter_type version_2">
                        <h4><a href="#filter_1" data-bs-toggle="collapse" class="opened">Categories</a></h4>
                        <div class="collapse show" id="filter_1">
                            <ul>
                                @foreach($categories as $category)
                                    <li>
                                        <label class="container_check">
                                            {{ $category['name'] }}
                                            {{--                                                <small>12</small>--}}
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- /filter_type -->
                    </div>
                    <!-- /filter_type -->
                    <div class="filter_type version_2">
                        <h4><a href="#filter_2" data-bs-toggle="collapse" class="opened">Color</a></h4>
                        <div class="collapse show" id="filter_2">
                            <ul>
                                <li>
                                    <label class="container_check">Blue <small>06</small>
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">Red <small>12</small>
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">Orange <small>17</small>
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">Black <small>43</small>
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /filter_type -->
                    <div class="filter_type version_2">
                        <h4><a href="#filter_3" data-bs-toggle="collapse" class="closed">Brands</a></h4>
                        <div class="collapse" id="filter_3">
                            <ul>
                                <li>
                                    <label class="container_check">Adidas <small>11</small>
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">Nike <small>08</small>
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">Vans <small>05</small>
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">Puma <small>18</small>
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /filter_type -->
                    <div class="filter_type version_2">
                        <h4><a href="#filter_4" data-bs-toggle="collapse" class="closed">Price</a></h4>
                        <div class="collapse" id="filter_4">
                            <ul>
                                <li>
                                    <label class="container_check">$0 — $50<small>11</small>
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">$50 — $100<small>08</small>
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">$100 — $150<small>05</small>
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">$150 — $200<small>18</small>
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /filter_type -->
                    <div class="buttons">
                        <a href="#0" class="btn_1">Filter</a> <a href="#0" class="btn_1 gray">Reset</a>
                    </div>
                </div>
            </aside>
            <!-- /col -->
            <div class="col-lg-9">
                <div class="row small-gutters">
                    @if(!empty($products))
                        @foreach($products as $product)
                            @php
                                $images = explode(',', $product['p_image']);
                            @endphp

                            <div class="col-6 col-md-4">
                                <div class="grid_item">
                                    @if($product['type'] == 1)
                                        <span class="ribbon off">-20%</span>
                                    @endif
                                    <figure>
                                        <a href="{{ routeClient("shop/{$product['p_slug']}") }}">
                                            <img class="img-fluid lazy"
                                                 src="{{ routeClient($images[0]) }}"
                                                 data-src="{{ routeClient($images[0]) }}"
                                                 alt=""
                                                 style="width: 100%; height: 350px; object-fit: fill;"
                                            >
                                        </a>
                                        @if($product['type'] == 1)
                                            <div data-countdown="2024/06/12" class="countdown"></div>
                                        @endif
                                    </figure>
                                    <a href="{{ routeClient("shop/{$product['p_slug']}") }}">
                                        <h3>{{ $product['p_name'] }}</h3>
                                    </a>
                                    <div class="price_box">
                                        <span class="new_price">
                                            {{ formatPrice($product['price_offer'] ?: $product['price']) . 'đ' }}
                                        </span>
                                        @if($product['type'] == 1)
                                            <span class="old_price">
                                                {{ formatPrice($product['price']) . 'đ' }}
                                            </span>
                                        @endif
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="#0" class="tooltip-1" data-bs-toggle="tooltip"
                                               data-bs-placement="left"
                                               title="Add to favorites"
                                            >
                                                <i class="ti-heart"></i>
                                                <span>Add to favorites</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#0" class="tooltip-1" data-bs-toggle="tooltip"
                                               data-bs-placement="left"
                                               title="Add to compare"
                                            >
                                                <i class="ti-control-shuffle"></i>
                                                <span>Add to compare</span>
                                            </a>
                                        </li>
                                        <li class="btn_addToCart" onclick="addToCart(event, '{{ $product['p_id'] }}')">
                                            <a href="#0" class="tooltip-1" data-bs-toggle="tooltip"
                                               data-bs-placement="left"
                                               title="Add to cart">
                                                <i class="ti-shopping-cart"></i>
                                                <span>Add to cart</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /grid_item -->
                            </div>
                        @endforeach
                    @else
                        <div class="d-flex justify-content-center align-items-center">
                            <h1 class="text-danger">Sorry - no data 🤬🤬</h1>
                        </div>
                    @endif
                </div>
                <!-- /row -->
                @if(!empty($product))
                    <div class="pagination__wrapper">
                        <ul class="pagination">
                            <li>
                                <a href="{{ $page > 1 ? routeClient($url . ($page - 1)) : routeClient($url . '1') }}"
                                   class="prev" title="previous page">&#10094;</a>
                            </li>

                            @for($i = 1; $i <= $totalPage; $i++)
                                <li>
                                    <a href="{{ routeClient($url . $i) }}"
                                       class="{{ $i == $page ? 'active' : '' }}">
                                        {{ $i }}
                                    </a>
                                </li>
                            @endfor

                            <li>
                                <a href="{{ routeClient($url . ($page == $totalPage ? $page : $page + 1)) }}"
                                   class="next" title="next page">&#10095;</a>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
            <!-- /col -->
        </div>
        <!-- /row -->

    </div>
    <!-- /container -->
@endsection

@section('javascript')
    <script src="{{ asset('js/product.js') }}"></script>
@endsection
