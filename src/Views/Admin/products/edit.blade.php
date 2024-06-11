@extends('layouts.master')
@section('title', 'Edit Product')
@section('main')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ routeAdmin('products') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Product</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ routeAdmin() }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ routeAdmin('products') }}">Products</a></div>
                <div class="breadcrumb-item">Edit Product</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Product</h2>
            <p class="section-lead">
                On this page you can edit a new Product and fill in all fields.
            </p>

            <form class="row" action="{{ routeAdmin('products/' . $product['p_id'] . '/update') }}" method="post" enctype="multipart/form-data">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Your Product</h4>
                        </div>
                        <div class="card-body">
                            @php
                                $images = explode(',', $product['p_image']);

//                                echo "<pre>";
//                                print_r($images);
//                                echo "</pre>";
//								echo "</br>";
								echo "<pre>";
                                print_r($product);
                                echo "</pre>";
                            @endphp
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text"
                                           class="form-control
                                           {{ isInvalid($_SESSION['errors']['name'] ?? null) }}"
                                           placeholder="Enter product name"
                                           name="name"
                                           value="{{ $product['p_name'] }}"
                                    >
                                    @isset($_SESSION['errors']['name'])
                                        <div class="invalid-feedback">
                                            {{ $_SESSION['errors']['name'] }}
                                        </div>
                                    @endisset
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="tel"
                                           class="form-control
                                           {{ isInvalid($_SESSION['errors']['price'] ?? null) }}"
                                           placeholder="Enter product price"
                                           name="price"
                                           value="{{ formatPrice($product['price_offer'] ?: $product['price']) }}"
                                    >
                                    @isset($_SESSION['errors']['price'])
                                        <div class="invalid-feedback">
                                            {{ $_SESSION['errors']['price'] }}
                                        </div>
                                    @endisset
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Quantity</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="tel"
                                           class="form-control
                                           {{ isInvalid($_SESSION['errors']['quantity'] ?? null) }}"
                                           placeholder="Enter product quantity"
                                           name="quantity"
                                           value="{{ $product['quantity'] }}"
                                    >
                                    @isset($_SESSION['errors']['quantity'])
                                        <div class="invalid-feedback">
                                            {{ $_SESSION['errors']['quantity'] }}
                                        </div>
                                    @endisset
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                                <div class="col-sm-12 col-md-7">
                                    <label for="image-upload" id="image-label">Choose File</label>
                                    <input type="file" name="images[]" multiple
                                           class="form-control {{ isInvalid($_SESSION['errors']['images'] ?? null) }}"/>
                                    @isset($_SESSION['errors']['images'])
                                        <div style="color: #dc3545; font-size: 80%; margin-top: 0.25rem; width: 100%;">
                                            {{ $_SESSION['errors']['images'] }}
                                        </div>
                                    @endisset
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image
                                    Current</label>
                                <div class="col-sm-12 col-md-3 d-flex">
                                    <div class="gallery">
                                        @foreach($images as $image)
                                            <div class="gallery-item" data-image="{{ routeClient($image) }}"
                                                 data-title="{{ $product['p_name'] }}">
                                                <img src="{{ routeClient($image) }}" alt="{{ $product['p_name'] }}"
                                                     style="width: 100%; height: 60px;">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" name="category">
                                        <option
                                                value="{{ $product['c_id'] }}"
                                                selected
                                                disabled
                                        >
                                            {{ $product['c_name'] }}
                                        </option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Type</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" name="type">
                                        <option value="{{ $product['type'] }}"
                                                selected
                                                disabled
                                        >
                                            {{ $product['type'] == 1 ? 'Sale' : 'No Sale' }}
                                        </option>
                                        <option value="0">No Sale</option>
                                        <option value="1">Sale</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" name="status">
                                        <option
                                                value="{{ $product['status'] }}"
                                                selected
                                                disabled
                                        >
                                            {{ $product['status'] == 1 ? 'Publish' : 'Draft' }}
                                        </option>
                                        <option value="1">Publish</option>
                                        <option value="0">Draft</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary">Edit Product</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('javascript')
    <script src="{{ asset('admin/js/page/features-post-create.js') }}"></script>
@endsection