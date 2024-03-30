<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <!--  Title -->
    <title>LOGIN - Ransas</title>
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
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-xl-7 col-xxl-8">
                        <a href="#" class="text-nowrap logo-img d-block px-4 py-9 w-100">
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
                                <h2 class="mb-3 fs-7 fw-bolder">ברוכים הבאים ל- RANSAS</h2>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">אימייל</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus
                                            aria-describedby="emailHelp">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">סיסמה</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <a class="fw-medium"
                                            href="{{ route('password.request') }}">שכחת את הסיסמא ?</a>
                                    </div>
                                    <button type="submit" name="submit"
                                        class="btn btn-primary w-100 py-8 mb-4 rounded-2">להתחבר</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Import Js Files -->
    <script src="{{ asset('public') }}/dist/libs/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('public') }}/dist/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="{{ asset('public') }}/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- core files -->
    <script src="{{ asset('public') }}/dist/js/app.min.js"></script>
    <script src="{{ asset('public') }}/dist/js/app.init.js"></script>
    <script src="{{ asset('public') }}/dist/js/app-style-switcher.js"></script>
    <script src="{{ asset('public') }}/dist/js/sidebarmenu.js"></script>

    <script src="{{ asset('public') }}/dist/js/custom.js"></script>
    <!-- current page js files -->

    <script src="{{ asset('public') }}/dist/js/custom.js"></script>
</body>

</html>
