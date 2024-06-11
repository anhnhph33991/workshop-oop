@extends('layouts.master')

@section('title', 'Checkout')
@section('main')
    <div class="container margin_30">
        <div class="page_header">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="{{ routeClient() }}">Home</a></li>
                    <li><a href="{{ routeClient('cart') }}">Cart</a></li>
                    <li>CheckOut</li>
                </ul>
            </div>
            <h1>Checkout Cart</h1>

        </div>
        <!-- /page_header -->
        <form action="{{ routeClient('check-out/add') }}" method="post" class="row">
            <div class="col-lg-4 col-md-6">
                <div class="step first">
                    <h3>1. User Info and Billing address</h3>

                    @if(!empty($_SESSION['user']))
                        @if(empty($_SESSION['user']['address_ship']))
                            <ul class="nav nav-tabs" id="tab_checkout" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#tab_1"
                                       role="tab" aria-controls="tab_1" aria-selected="true">Form Address</a>
                                </li>
                            </ul>
                            <div class="tab-content checkout">
                                <div class="tab-pane fade show active" id="tab_1" role="tabpanel"
                                     aria-labelledby="tab_1">
                                    <div class="form-group">
                                        <input type="email" class="form-control has-validation"
                                               placeholder="Email"
                                               name="email"
                                               value="{{ $_SESSION['user']['email'] ?? '' }}"
                                        >
                                        @isset($_SESSION['errors']['email'])
                                            <div class="invalid-feedback">
                                                {{ $_SESSION['errors']['email'] }}
                                            </div>
                                        @endisset
                                    </div>
                                    <hr>
                                    <div class="row no-gutters">
                                        <div class="col-6 form-group pr-1">
                                            <input type="text"
                                                   class="form-control {{ isInvalid($_SESSION['errors']['username'] ?? null) }}"
                                                   placeholder="UserName"
                                                   name="username"
                                                   value="{{ $_SESSION['user']['username'] ?? '' }}"
                                            >
                                            @isset($_SESSION['errors']['username'])
                                                <div class="invalid-feedback">
                                                    {{ $_SESSION['errors']['username'] }}
                                                </div>
                                            @endisset
                                        </div>
                                        <div class="col-6 form-group pl-1">
                                            <input type="tel"
                                                   class="form-control {{ isInvalid($_SESSION['errors']['phone'] ?? null) }}"
                                                   placeholder="Phone" name="phone"
                                                   value="{{ $_SESSION['user']['phone'] ?? '' }}"
                                            >
                                            @isset($_SESSION['errors']['phone'])
                                                <div class="invalid-feedback">
                                                    {{ $_SESSION['errors']['phone'] }}
                                                </div>
                                            @endisset
                                        </div>
                                    </div>
                                    <!-- /row -->
                                    <div class="form-group">
                                        <input type="text"
                                               class="form-control {{ isInvalid($_SESSION['errors']['address_shipping'] ?? null) }}"
                                               placeholder="Full Address"
                                               name="address_shipping">
                                        @isset($_SESSION['errors']['address_shipping'])
                                            <div class="invalid-feedback">
                                                {{ $_SESSION['errors']['address_shipping'] }}
                                            </div>
                                        @endisset
                                    </div>
                                </div>
                                <!-- /tab_1 -->
                            </div>
                        @else
                            <h1>Co Address</h1>
                        @endif
                    @else
                        <ul class="nav nav-tabs" id="tab_checkout" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#tab_1"
                                   role="tab" aria-controls="tab_1" aria-selected="true">Form Address</a>
                            </li>
                        </ul>
                        <div class="tab-content checkout">
                            <div class="tab-pane fade show active" id="tab_1" role="tabpanel"
                                 aria-labelledby="tab_1">
                                <div class="form-group">
                                    <input type="email"
                                           class="form-control {{ isInvalid($_SESSION['errors']['email'] ?? null) }}"
                                           placeholder="Email"
                                           name="email">
                                    @isset($_SESSION['errors']['email'])
                                        <div class="invalid-feedback">
                                            {{ $_SESSION['errors']['email'] }}
                                        </div>
                                    @endisset
                                </div>
                                <hr>
                                <div class="row no-gutters">
                                    <div class="col-6 form-group pr-1">
                                        <input type="text" class="form-control {{ isInvalid($_SESSION['errors']['username'] ?? null) }}"
                                               placeholder="UserName" name="username">
                                        @isset($_SESSION['errors']['username'])
                                            <div class="invalid-feedback">
                                                {{ $_SESSION['errors']['username'] }}
                                            </div>
                                        @endisset
                                    </div>
                                    <div class="col-6 form-group pl-1">
                                        <input type="tel" class="form-control {{ isInvalid($_SESSION['errors']['phone'] ?? null) }}" placeholder="Phone" name="phone">
                                        @isset($_SESSION['errors']['phone'])
                                            <div class="invalid-feedback">
                                                {{ $_SESSION['errors']['phone'] }}
                                            </div>
                                        @endisset
                                    </div>
                                </div>
                                <!-- /row -->
                                <div class="form-group">
                                    <input type="text" class="form-control {{ isInvalid($_SESSION['errors']['address_shipping'] ?? null) }}"
                                           placeholder="Full Address"
                                           name="address_shipping">
                                    @isset($_SESSION['errors']['address_shipping'])
                                        <div class="invalid-feedback">
                                            {{ $_SESSION['errors']['address_shipping'] }}
                                        </div>
                                    @endisset
                                </div>
                            </div>
                            <!-- /tab_1 -->
                        </div>
                    @endif
                </div>
                <!-- /step -->
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="step middle payments">
                    <h3>2. Payment and Shipping</h3>
                    <ul>
                        <li>
                            <label class="container_radio">Thanh Toan Nhan Hang
                                <a href="#0" class="info"
                                   data-bs-toggle="modal"
                                   data-bs-target="#payments_method"></a>
                                <input type="radio" name="payment" value="0" checked>
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label class="container_radio">Momo
                                <a href="#0" class="info"
                                   data-bs-toggle="modal"
                                   data-bs-target="#payments_method"></a>
                                <input type="radio" name="payment" value="1">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                    </ul>
                </div>
                <!-- /step -->

            </div>
            <div class="col-lg-4 col-md-6">
                <div class="step last">
                    <h3>3. Order Summary</h3>
                    <div class="box_general summary">
                        <ul>
                            @foreach($dataCart as $cart)
                                <li class="clearfix">
                                    <em>{{ $cart['quantity'] }}x <strong>{{ $cart['name'] }}</strong></em>
                                    <span>{{ number_format(($cart['price_offer'] ?: $cart['price']) * $cart['quantity'])}}đ</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="total clearfix">
                            TOTAL
                            <span>{{ number_format(reduce_price($dataCart)) }}đ</span>
                        </div>
                        {{--                        <a href="{{ routeClient('confirm') }}" class="btn_1 full-width">Confirm and Pay</a>--}}
                        <input type="hidden" value="{{ reduce_price($dataCart) }}" name="priceTotal">
                        <button type="submit" class="btn_1 full-width" name="payUrl">Confirm</button>

                    </div>
                    <!-- /box_general -->
                </div>
                <!-- /step -->
            </div>
        </form>
        <!-- /row -->
    </div>
@endsection
