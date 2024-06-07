@extends('layouts.master')

@section('title')
    Edit User: {{ $user['username'] }}
@endsection

@section('main')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ routeAdmin('users') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ routeAdmin() }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ routeAdmin('users') }}">Users</a></div>
                <div class="breadcrumb-item">Edit User</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Users</h2>
            <p class="section-lead">
                Edit users easy
            </p>

            <form class="row" action="{{ routeAdmin('users/' . $user['id'] . '/update') }}" method="post"
                  enctype="multipart/form-data">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Your User</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text"
                                           class="form-control {{ isInvalid($_SESSION['errors']['username'] ?? null) }}"
                                           placeholder="Enter username"
                                           name="username"
                                           value="{{ $user['username']  }}"
                                    >
                                    @isset($_SESSION['errors']['username'])
                                        <div class="invalid-feedback">
                                            {{ $_SESSION['errors']['username'] }}
                                        </div>
                                    @endisset
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text"
                                           class="form-control {{ isInvalid($_SESSION['errors']['email'] ?? null) }}"
                                           placeholder="Enter email"
                                           name="email"
                                           value="{{ $user['email'] }}"
                                    >
                                    @isset($_SESSION['errors']['email'])
                                        <div class="invalid-feedback">
                                            {{ $_SESSION['errors']['email'] }}
                                        </div>
                                    @endisset
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="password"
                                           class="form-control {{ isInvalid($_SESSION['errors']['password'] ?? null) }}"
                                           placeholder="Enter password"
                                           name="password">
                                    @isset($_SESSION['errors']['password'])
                                        <div class="invalid-feedback">
                                            {{ $_SESSION['errors']['password'] }}
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
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image
                                    Current</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="gallery">
                                        <div class="gallery-item" data-image="{{ routeClient($user['image']) }}"
                                             data-title="{{ $user['username'] }}" style="width: 250px; height: 250px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Address</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text"
                                           class="form-control {{ isInvalid($_SESSION['errors']['address'] ?? null) }}"
                                           placeholder="Enter address"
                                           name="address"
                                           value="{{ $user['address'] }}"
                                    >
                                    @isset($_SESSION['errors']['address'])
                                        <div class="invalid-feedback">
                                            {{ $_SESSION['errors']['address'] }}
                                        </div>
                                    @endisset
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="tel"
                                           class="form-control {{ isInvalid($_SESSION['errors']['phone'] ?? null) }}"
                                           placeholder="Enter phone"
                                           name="phone"
                                           value="{{ $user['phone'] }}"
                                    >
                                    @isset($_SESSION['errors']['phone'])
                                        <div class="invalid-feedback">
                                            {{ $_SESSION['errors']['phone'] }}
                                        </div>
                                    @endisset
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Role</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" name="role">
                                        <option value="{{ $user['role'] }}" selected disabled>{{ $user['role'] == 1 ? "Admin" : "User" }}</option>
                                        <option value="0">User</option>
                                        <option value="1">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary">Edit User</button>
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