<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <!--  Title -->
    <title>Ransas</title>
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
                                <div class="position-relative text-center my-4">
                                    <p
                                        class="mb-0 fs-4 px-3 d-inline-block bg-white text-dark z-index-5 position-relative">
                                        Reset Pasword</p>
                                    <span
                                        class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                                </div>
                                <form method="POST" action="{{ route('password.update') }}">

                                    @csrf

                                    <input type="hidden" name="token" value="{{ $token }}">



                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" name="email" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            id="exampleInputPassword1">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                                        <input type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" id="exampleInputPassword1">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit"
                                        class="btn btn-primary w-100 py-8 mb-4 rounded-2">Reset</button>

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
