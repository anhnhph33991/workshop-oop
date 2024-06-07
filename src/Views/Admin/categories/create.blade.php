@extends('layouts.master')
@section('title', 'Create Category')
@section('main')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ routeAdmin('categories') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Create New Category</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ routeAdmin('categories') }}">Categories</a></div>
                <div class="breadcrumb-item">Create New Category</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Create New Category</h2>
            <p class="section-lead">
                On this page you can create a new category and fill in all fields.
            </p>

            <form class="row" action="{{ routeAdmin('categories/store') }}" method="post" enctype="multipart/form-data">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Write Your Category</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text"
                                           class="form-control {{ isInvalid($_SESSION['errors']['name'] ?? null) }}"
                                           placeholder="Enter name category" name="name">
                                    @isset($_SESSION['errors']['name'])
                                        <div class="invalid-feedback">
                                            {{ $_SESSION['errors']['name'] }}
                                        </div>
                                    @endisset
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                                <div class="col-sm-12 col-md-7">
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">Choose File</label>
                                        <input type="file" name="image" id="image-upload"
                                               class="form-control {{ isInvalid($_SESSION['errors']['image'] ?? null) }}"/>
                                        @isset($_SESSION['errors']['image'])
                                            <div class="invalid-feedback">
                                                {{ $_SESSION['errors']['image'] }}
                                            </div>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary">Create Category</button>
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