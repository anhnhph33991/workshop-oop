<header class="version_1">
    <div class="layer"></div><!-- Mobile menu overlay mask -->
    <div class="main_header">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
                    <div id="logo">
                        <a href="{{ routeClient() }}"><img src="{{ asset('client/img/logo.svg') }}" alt="" width="100"
                                height="35"></a>
                    </div>
                </div>
                <nav class="col-xl-6 col-lg-7">
                    <a class="open_close" href="javascript:void(0);">
                        <div class="hamburger hamburger--spin">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                    <!-- Mobile menu button -->
                    <div class="main-menu">
                        <div id="header_menu">
                            <a href="index.html"><img src="img/logo_black.svg" alt="" width="100" height="35"></a>
                            <a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
                        </div>
                        <ul>
                            <li>
                                <a href="{{ routeClient() }}">Home</a>
                            </li>
                            <li>
                                <a href="{{ routeClient('products') }}">Shop</a>
                            </li>
                            <li>
                                <a href="{{ routeClient('about') }}">About</a>
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);" class="show-submenu">Extra Pages</a>
                                <ul>
                                    <li><a href="header-2.html">Header Style 2</a></li>
                                    <li><a href="header-3.html">Header Style 3</a></li>
                                    <li><a href="header-4.html">Header Style 4</a></li>
                                    <li><a href="header-5.html">Header Style 5</a></li>
                                    <li><a href="404.html">404 Page</a></li>
                                    <li><a href="sign-in-modal.html">Sign In Modal</a></li>
                                    <li><a href="contacts.html">Contact Us</a></li>
                                    <li><a href="about.html">About 1</a></li>
                                    <li><a href="about-2.html">About 2</a></li>
                                    <li><a href="modal-advertise.html">Modal Advertise</a></li>
                                    <li><a href="modal-newsletter.html">Modal Newsletter</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#0">Buy Template</a>
                            </li>
                        </ul>
                    </div>
                    <!--/main-menu -->
                </nav>
                <div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-end">
                    <a class="phone_top" href="tel://9438843343">
                        <strong>
                            <span>Supports ?</span>
                            0367253666
                        </strong>
                    </a>
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
    
    <!-- /main_header -->
    @include('layouts.partials.nav')
    <!-- /main_nav -->
</header>