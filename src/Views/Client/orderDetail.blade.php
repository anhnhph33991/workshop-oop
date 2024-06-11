@extends('layouts.master')
@section('title', 'Order Detail')

@section('main')
    <div class="container">

        @php
            $images = explode(',', $order['image']);
			$totalPrice = ($order['p_priceOffer'] ?: $order['p_price']) * $order['od_qty'];

			switch ($order['o_status']){
				case '0':
					$status = 'Cho Xac Nhan';
					break;
					case '1':
					$status = 'Da Xac Nhan';
					break;
					case '2':
					$status = 'Dang Chuan Bi Hang';
					break;
					case '3':
					$status = 'Dang Giao Hang';
					break;
					case '4':
					$status = 'Da Giao Hang';
					break;
					case '5':
					$status = 'Da Huy';
					break;
					case '6':
					$status = 'Hoan Hang';
					break;
			}

        @endphp

        <h1>Detail: {{ $order['p_name'] }}</h1>

        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
            <div class="col-sm-12 col-md-7">
                @foreach($images as $image)
                    <img src="{{ routeClient($image) }}" alt="" style="width: 100px; height: 100px">
                @endforeach
            </div>
        </div>
        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Total Price</label>
            <div class="col-sm-12 col-md-7">
                <input type="text"
                       class="form-control"
                       name="price"
                       value="{{ number_format($totalPrice) }}"
                       disabled
                >
            </div>
        </div>
        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Address Shipping</label>
            <div class="col-sm-12 col-md-7">
                <input type="text"
                       class="form-control"
                       name="address"
                       value="{{ $order['o_addressShipping'] }}"
                       disabled
                >
            </div>
        </div>
        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nguoi Nhan</label>
            <div class="col-sm-12 col-md-7">
                <input type="text"
                       class="form-control"
                       name="name"
                       value="{{ $order['o_username'] }}"
                       disabled
                >
            </div>
        </div>

        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tinh Trang Don</label>
            <div class="col-sm-12 col-md-7">
                <input type="text"
                       class="form-control"
                       name="name"
                       value="{{ $status }}"
                       disabled
                >
            </div>
        </div>

        @if($order['o_status'] == 0)
            <div class="form-group row mb-4">
                <a href="{{ routeClient("my-orders/{$order['od_id']}/delete") }}" class="btn btn-danger">Huy Don</a>
            </div>
        @endif

    </div>
@endsection