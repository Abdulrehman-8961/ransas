<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <!--  Title -->
    <title>Forgot Password - Ransas</title>
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
    <style>
        .btn-primary {
            background-color: #3CB6C1 !important;
            border-color: #3CB6C1 !important;
        }

        a {
            color: #d2691e !important;
        }
    </style>
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
                            <h4>RANSAS</h4>
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
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show mb-9 mt-3"
                                        role="alert">
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="position-relative text-center my-4">
                                    <p
                                        class="mb-0 fs-4 px-3 d-inline-block bg-white text-dark z-index-5 position-relative">
                                        לאפס את הסיסמה</p>
                                    <span
                                        class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                                </div>
                                <form method="POST" action="{{ route('password.email') }}">@csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">אימייל</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" name="email" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">
                                        {{ __('שלח קישור לאיפוס סיסמה') }}</button>

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
