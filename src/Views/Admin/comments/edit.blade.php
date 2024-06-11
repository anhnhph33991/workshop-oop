@extends('layouts.master')
@section('title', 'Create Category')
@section('main')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ routeAdmin('comments') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Edit New Comments</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Comments</a></div>
            <div class="breadcrumb-item">Edit New Comments</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Edit New Comments</h2>
        <p class="section-lead">
            On this page you can Edit a new Comments and fill in all fields.
        </p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Write Your Comments</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="text-danger">Rat tiec k ho tro sua comment cua user</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
<script src="{{ asset('admin/js/page/features-post-create.js') }}"></script>
@endsection

