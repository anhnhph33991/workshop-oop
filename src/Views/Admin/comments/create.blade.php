@extends('layouts.master')
@section('title', 'Create Category')
@section('main')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ routeAdmin('comments') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Create New Comment</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Comments</a></div>
                <div class="breadcrumb-item">Create New Comments</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Create New Comment</h2>
            <p class="section-lead">
                On this page you can create a new Comment and fill in all fields.
            </p>

            <form action="{{ routeAdmin('comments/store') }}" method="post" class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Write Your Comment</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea class="summernote-simple" name="content"></textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Select
                                    Product</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" name="product_id">
                                        @foreach($products as $product)
                                            <option value="{{ $product['id'] }}">{{ $product['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Select
                                    User</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" name="user_id">
                                        @foreach($users as $user)
                                            <option value="{{ $user['id'] }}">{{ $user['username'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary">Create Post</button>
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
