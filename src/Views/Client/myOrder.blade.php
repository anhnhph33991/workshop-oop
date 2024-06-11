@extends('layouts.master')

@section('title', 'My Order')

@section('main')
    <div class="min-vh-100 container">
        <table class="table mt-5">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Qty</th>
                <th scope="col">SubTotal</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>

            @foreach($productOrder as $data)

                @php
                    $images = explode(',', $data['image']);
                    $subTotal = ($data['p_priceOffer'] ?: $data['p_price']) * $data['od_qty'];

//                    echo "<pre>";
//                    print_r($data);
//                    echo "</pre>";

                @endphp
                <tr>
                    <th scope="row">{{ $data['or_id'] }}</th>
                    <td>
                        <img src="{{ routeClient($images[0]) }}" alt="" style="width: 100px; height: 100px">
                    </td>
                    <td>{{ $data['p_name'] }}</td>
                    <td>{{ $data['od_qty'] }}</td>
                    <td>{{ number_format($subTotal) }}đ</td>
                    <td>
                        <a href="{{ routeClient('my-orders/' . $data['od_id']) }}"
                           class="btn btn-success">Chi Tiet</a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
