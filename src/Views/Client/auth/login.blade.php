@extends('layouts.master')
@section('title', 'LuxChill Login')

@section('main')
<div class="container margin_30">
    <div class="page_header">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{ routeClient() }}">Home</a></li>
                <li>Login</li>
            </ul>
        </div>
        <h1>Login Form</h1>
    </div>
    <!-- /page_header -->
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6 col-md-8">
            <div class="box_account">
                <h3 class="client">Đã là khách hàng</h3>
                <form class="form_container" action="{{ routeClient('handle-login') }}" method="post">
                    <div class="row no-gutters">
                        <div class="col-lg-6 pr-lg-1">
                            <a href="#0" class="social_bt facebook">Login with Facebook</a>
                        </div>
                        <div class="col-lg-6 pl-lg-1">
                            <a href="#0" class="social_bt google">Login with Google</a>
                        </div>
                    </div>
                    <div class="divider"><span>Or</span></div>
                    <div class="form-group">
                        <input type="email" class="form-control {{ isInvalid($_SESSION['errors']['email'] ?? null) }}"
                            name="email" id="email" placeholder="Email*">
                        @isset($_SESSION['errors']['email'])
                        <div class="invalid-feedback">
                            {{ $_SESSION['errors']['email'] }}
                        </div>
                        @endisset
                    </div>
                    <div class="form-group">
                        <input type="password"
                            class="form-control {{ isInvalid($_SESSION['errors']['password'] ?? null) }}"
                            name="password" id="password_in" value="" placeholder="Password*">
                        @isset($_SESSION['errors']['password'])
                        <div class="invalid-feedback">
                            {{ $_SESSION['errors']['password'] }}
                        </div>
                        @endisset
                    </div>
                    <div class="clearfix add_bottom_15">
                        <div class="checkboxes float-start">
                            <label class="container_check">Remember me
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="float-end">
                            <a id="forgot" href="{{ routeClient('forgot-password') }}">
                                Quên Mật Khẩu?
                            </a>
                        </div>
                    </div>
                    <div class="text-center"><input type="submit" name="submit" value="Log In" class="btn_1 full-width">
                    </div>
                    <div class="py-3">
                        <div class="float-end">
                            <a id="forgot" href="{{ routeClient('register') }}">
                                Chưa có tài khoản?
                            </a>
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
            <!-- /row -->
        </div>
    </div>
    <!-- /row -->
</div>
@endsection