@extends('layouts.master')
@section('title', 'Create Product')
@section('main')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ routeAdmin('products') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Create New Product</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ routeAdmin() }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ routeAdmin('products') }}">Product</a></div>
                <div class="breadcrumb-item">Create New Product</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Create New Product</h2>
            <p class="section-lead">
                On this page you can create a new Product and fill in all fields.
            </p>

            <form class="row" action="{{ routeAdmin('products/store') }}" method="post" enctype="multipart/form-data">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Write Your Product</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text"
                                           class="form-control
                                           {{ isInvalid($_SESSION['errors']['name'] ?? null) }}"
                                           placeholder="Enter product name"
                                           name="name"
                                    >
                                    @isset($_SESSION['errors']['name'])
                                        <div class="text-danger">
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
                                           name="quantity">
                                    @isset($_SESSION['errors']['quantity'])
                                        <div class="invalid-feedback">
                                            {{ $_SESSION['errors']['quantity'] }}
                                        </div>
                                    @endisset
                                </div>
                            </div>
                            {{--                            <div class="form-group row mb-4">--}}
                            {{--                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>--}}
                            {{--                                <div class="col-sm-12 col-md-7">--}}
                            {{--                                    <div id="image-preview" class="image-preview">--}}
                            {{--                                        <label for="image-upload" id="image-label">Choose File</label>--}}
                            {{--                                        <input type="file" name="image" id="image-upload"/>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}

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
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" name="category">
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
                                        <option value="0" selected>No Sale</option>
                                        <option value="1">Sale</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" name="status">
                                        <option value="1" selected>Publish</option>
                                        <option value="0">Draft</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary">Create Product</button>
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