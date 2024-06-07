@extends('layouts.master')
@section('title', 'LuxChill Register')

@section('main')
<div class="container margin_30">
    <div class="page_header">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{ routeClient() }}">Home</a></li>
                <li>Register</li>
            </ul>
        </div>
        <h1>Register Form</h1>
    </div>
    <!-- /page_header -->
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6 col-md-8">
            <div class="box_account">
                <h3 class="new_client">New Client</h3>
                <small class="float-right pt-2">* Required Fields</small>
                <form class="form_container" action="{{ routeClient('handle-register') }}" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control {{ isInvalid($_SESSION['errors']['username'] ?? null) }}"
                            name="username" placeholder="Họ và tên">
                        @isset($_SESSION['errors']['username'])
                        <div class="invalid-feedback">
                            {{ $_SESSION['errors']['username'] }}
                        </div>
                        @endisset
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control {{ isInvalid($_SESSION['errors']['email'] ?? null) }}"
                            id="password_in_2" name="email" id="email_2" placeholder="Email*">
                        @isset($_SESSION['errors']['email'])
                        <div class="invalid-feedback">
                            {{ $_SESSION['errors']['email'] }}
                        </div>
                        @endisset
                    </div>
                    <div class="form-group">
                        <input type="password"
                            class="form-control {{ isInvalid($_SESSION['errors']['password'] ?? null) }}"
                            name="password" id="password_in_2" value="" placeholder="Password*">
                        @isset($_SESSION['errors']['password'])
                        <div class="invalid-feedback">
                            {{ $_SESSION['errors']['password'] }}
                        </div>
                        @endisset
                    </div>
                    <div class="text-center">
                        <input type="submit" name="submit" value="Register" class="btn_1 full-width">
                    </div>
                    <div class="py-3">
                        <div class="float-end">
                            <a id="forgot" href="{{ routeClient('login') }}">Đã có tài khoản ?</a>
                        </div>
                    </div>
                </form>
                <!-- /form_container -->
            </div>
            <!-- /box_account -->
            <div class="row">
                <div class="col-md-6 d-none d-lg-block">
                    <ul class="list_ok">
                        <li>CBD Đéo Phê</li>
                        <li>Ma túy đá 6789</li>
                        <li>LuxChill</li>
                    </ul>
                </div>
                <div class="col-md-6 d-none d-lg-block">
                    <ul class="list_ok">
                        <li>Zl: 0367253666</li>
                        <li>Support 24/7</li>
                        <li>Sống bằng tình cảm</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
</div>
@endsection