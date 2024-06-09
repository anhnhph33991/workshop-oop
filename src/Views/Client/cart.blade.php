@extends('layouts.master')
@section('title', 'Carts')

@section('main')
    <main class="bg_gray">
        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Category</a></li>
                        <li>Page active</li>
                    </ul>
                </div>
                <h1>Cart page</h1>
            </div>
            <!-- /page_header -->

            @if(!empty($carts))
                <table class="table table-striped cart-list">
                    <thead>
                    <tr>
                        <th>
                            Product
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Quantity
                        </th>
                        <th>
                            Subtotal
                        </th>
                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($carts as $key => $cart)
                        @php
                            $images = explode(',', $cart['image']);
                            $subTotal = ($cart['price_offer'] ?: $cart['price']) * $cart['quantity'];
                            $dataId = !empty($_SESSION['user']) ? $cart['c_id'] : $key;
                        @endphp
                        <tr>
                            <td>
                                <div class="thumb_cart">
                                    <img src="{{ routeClient($images[0]) }}"
                                         data-src="{{ routeClient($images[0]) }}"
                                         class="lazy" alt="Image">
                                </div>
                                <span class="item_cart">{{ $cart['name'] }}</span>
                            </td>
                            <td>
                                <strong class="price-{{ $dataId }}"
                                        data-price="{{ $cart['price_offer'] ?: $cart['price'] }}">
                                    {{ number_format($cart['price_offer'] ?: $cart['price']) }}đ
                                </strong>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-success btnAdd" data-id="{{ $dataId }}">+</button>
                                    <input type="tel"
                                           class="w-25 border-5 qty-{{ $dataId }}"
                                           value="{{ $cart['quantity'] }}"
                                           min="1"
                                           disabled>
                                    <button class="btn btn-danger btnRemove" data-id="{{ $dataId }}">-</button>
                                </div>
                            </td>
                            <td>
                                <strong class="total-{{ $dataId }}"
                                        data-total="{{ $subTotal }}"
                                        data-id-cart="{{ $cart['c_id'] }}"
                                        data-id-product="{{ $cart['p_id'] }}"
                                        data-id-cartId="{{ $cart['cart_id'] }}"
                                >
                                    {{ formatPrice($subTotal) }}đ
                                </strong>
                            </td>
                            <td class="options">

                                @php

                                    if(isset($_SESSION['user'])){
                                        $urlDelete = "cart/delete/{$cart['c_id']}";
                                    }else{
                                        $urlDelete = "cart/delete/$key";
                                    }

                                @endphp

                                <a href="{{ routeClient($urlDelete) }}">
                                    <i class="ti-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h1>Ban chua co san pham nao trong gio hang. <a href="{{ routeClient('shops') }}">Shopping now</a></h1>
            @endif
            <!-- /cart_actions -->
        </div>
        <!-- /container -->

        <div class="box_cart">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <ul>
                            <li class="price-total" data-PriceTotal="{{ reduce_price($carts) }}">
                                <span>Total</span>
                                @if(!empty($carts))
                                    {{ number_format(reduce_price($carts)) }}đ
                                @else
                                    0đ
                                @endif
                            </li>
                        </ul>
                        <a href="{{ routeClient('check-out') }}" class="btn_1 full-width cart">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /box_cart -->

    </main>
@endsection

@section('javascript')
    <script src="{{ asset('js/cart.js') }}"></script>
@endsection
