<!DOCTYPE html>
<html lang="en">

<head>
    <!--  Title -->
    <title>Kleen-air Filters</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Mordenize" />
    <meta name="author" content="" />
    <meta name="keywords" content="Mordenize" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--  Favicon -->
    <!--<link rel="shortcut icon" type="image/png" href="{{ asset('public') }}/dist/images/logos/favicon.ico" />-->
    @yield('css')
    <!-- Core Css -->
    <link id="themeColors" rel="stylesheet" href="{{ asset('public') }}/dist/css/style.min.css" />
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('public') }}/dist/images/logos/favicon.ico" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('public') }}/dist/images/logos/favicon.ico" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-xl-7 col-xxl-8">
                        <a href="./index.html" class="text-nowrap logo-img d-block px-4 py-9 w-100">
                            {{-- <img src="{{asset('public')}}/dist/images/logos/dark-logo.svg" width="180" alt=""> --}}
                            <h3 class="text-dark fw-bolder">Marketing Center Inc.</h3>
                        </a>
                        <div class="d-none d-xl-flex align-items-center justify-content-center"
                            style="height: calc(100vh - 80px);">
                            <img src="{{ asset('public') }}/dist/images/backgrounds/login-security.svg" alt=""
                                class="img-fluid" width="500">
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-4">
                        <div
                            class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
                            <div class="col-sm-8 col-md-6 col-xl-9">
                                @if (session('resent'))
                                    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show mb-3"
                                        role="alert">
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif

                                <p class=" mb-9">
                                    {{ __('Before proceeding, please check your email for a verification link.') }},
                                    {{ __('If you did not receive the email') }},
                                </p>

                                <div class="position-relative text-center my-4">
                                    <p
                                        class="mb-0 fs-4 px-3 d-inline-block bg-white text-dark z-index-5 position-relative">
                                        Verify Your Email</p>
                                    <span
                                        class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                                </div>
                                <form method="POST" action="{{ route('verification.resend') }}">@csrf

                                    <button type="submit"
                                        class="btn btn-primary w-100 py-8 mb-4 rounded-2">{{ __('click here to request another') }}</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--  Import Js Files -->
    <script src="{{ asset('public') }}/dist/libs/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('public') }}/dist/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="{{ asset('public') }}/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!--  core files -->
    <script src="{{ asset('public') }}/dist/js/app.min.js"></script>
    <script src="{{ asset('public') }}/dist/js/app.init.js"></script>
    <script src="{{ asset('public') }}/dist/js/app-style-switcher.js"></script>
    <script src="{{ asset('public') }}/dist/js/sidebarmenu.js"></script>

    <script src="{{ asset('public') }}/dist/js/custom.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    @yield('javascript')
</body>

</html>
