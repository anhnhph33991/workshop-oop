@extends('layouts.master')
@section('title', 'Create Category')
@section('main')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ routeAdmin('orders') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit New Order</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Orders</a></div>
                <div class="breadcrumb-item">Edit New Orders</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit New Order</h2>
            <p class="section-lead">
                On this page you can Edit a new Order and fill in all fields.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Write Your Order</h4>
                        </div>

                        @php
//                        echo "<pre>";
//                        print_r($orders);
//                        echo "</pre>";
							$images = explode(',', $orders['p_image']);

                            switch ($orders['o_status']){
                                case "0":
                                    $status = "Cho Xac Nhan";
                                    break;
                                    case "1":
                                        $status = "Da Xac Nhan";
                                    break;
                                    case "2":
                                        $status = "Dang Chuan Bi Hang";
                                    break;
                                    case "3":
                                        $status = "Dang Giao Hang";
                                    break;
                                    case "4":
                                        $status = "Da Giao Hang";
                                    break;
                                    case "5":
                                        $status = "Da Huy";
                                    break;
                                    case "6":
                                        $status = "Hoan Hang";
                                    break;

                            }

                        @endphp

                        <form action="{{ routeAdmin("orders/{$orders['od_id']}/update") }}" method="post" class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Product
                                    Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" value="{{ $orders['od_productName'] }}"
                                           disabled>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control"
                                           value="{{ number_format(($orders['od_priceOffer'] ?: $orders['od_price']) * $orders['od_qty']) }}"
                                           disabled>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" name="status">
                                        <option value="{{ $order['o_status'] }}" disabled selected>{{ $status }}</option>
                                        <option value="0">Cho Xac Nhan</option>
                                        <option value="1">Da Xac Nhan</option>
                                        <option value="2">Dang Chuan Bi Hang</option>
                                        <option value="3">Dang Giao Hang</option>
                                        <option value="4">Da Giao Hang</option>
                                        <option value="5">Da Huy</option>
                                        <option value="6">Hoan Hang</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary">Edit Order</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script src="{{ asset('admin/js/page/features-post-create.js') }}"></script>
@endsection
