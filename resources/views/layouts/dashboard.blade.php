<!doctype html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">

    <title>Ramsas</title>


    <link rel="stylesheet" href="{{ asset('public') }}/dist/libs/owl.carousel/dist/assets/owl.carousel.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="shortcut icon" href="{{ asset('public') }}/dist/dashboard_assets/media/photos/fav.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/dist/dashboard_assets/media/photos/fav.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/dist/dashboard_assets/media/photos/fav.png">

    <link rel="stylesheet" href="{{ asset('public') }}/dist/libs/daterangepicker/daterangepicker.css">
    <link rel="stylesheet"
        href="{{ asset('public') }}/dist/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="{{ asset('public') }}/dist/libs/pickadate-jalaali/lib/themes/default.css">
    <link rel="stylesheet" href="{{ asset('public') }}/dist/libs/pickadate-jalaali/lib/themes/default.date.css">
    <link rel="stylesheet" href="{{ asset('public') }}/dist/libs/pickadate-jalaali/lib/themes/default.time.css">


    <link rel="stylesheet" href="{{ asset('public') }}/dist/libs/select2/dist/css/select2.min.css">
    <!-- Core Css -->

    <link rel="stylesheet" href="{{ asset('public') }}/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">

    <link id="themeColors" rel="stylesheet" href="{{ asset('public') }}/dist/css/style.min.css" />
    <link rel="stylesheet" href="{{ asset('public') }}/dist/libs/sweetalert2/dist/sweetalert2.min.css">

    <style type="text/css">
        .form-group {
            margin-bottom: 15px;
        }

        .error {
            color: red;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: none;
            background-color: transparent;
            border-radius: 0px;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 10px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb {
            border-radius: 2px;
            background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0.44, #9e9e9e), color-stop(0.72, #9e9e9e), color-stop(0.86, #9e9e9e));

        }

        .fc-timegrid-event .fc-event-time {

            color: black;
        }

        .fc-v-event .fc-event-title {
            color: black;
            font-weight: 600;
        }

        .body-wrapper>.container-fluid,
        .body-wrapper>.container-lg,
        .body-wrapper>.container-md,
        .body-wrapper>.container-sm,
        .body-wrapper>.container-xl,
        .body-wrapper>.container-xxl {
            max-width: 100%;
        }

        .bg-purple {
            background: #3CB6C1 !important;
            color: white !important
        }

        .text-purple {

            color: #3CB6C1 !important
        }

        .select2-dropdown {
            width: 100%;
        }

        .select2-container {
            width: 100%
        }
    </style>



<body>

    <div class="preloader">
        <img src="{{ asset('public') }}/dist/images/logos/favicon.ico" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('public') }}/dist/images/logos/favicon.ico" alt="loader" class="lds-ripple img-fluid" />
    </div>






    <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed">
        @include('layouts.sidebar')
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>

                    </ul>

                    <div class="d-block d-lg-none">
                        <img src="/dist/dashboard_assets/media/photos/logo.png" class="dark-logo" width="180"
                            alt="" />
                        <img src="/dist/dashboard_assets/media/photos/logo.png" class="light-logo" width="180"
                            alt="" />
                    </div>
                    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="p-2">
                            <i class="ti ti-dots fs-7"></i>
                        </span>
                    </button>



                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">

                        <div class="d-flex align-items-center justify-content-between">
                            <a href="javascript:void(0)"
                                class="nav-link d-flex d-lg-none align-items-center justify-content-center"
                                type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                                aria-controls="offcanvasWithBothOptions">
                                <i class="ti ti-align-justified fs-7"></i>
                            </a>
                            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">

                                <li class="nav-item dropdown">
                                    <a class="nav-link pe-0" href="javascript:void(0)" id="drop1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <div class="user-profile-img">
                                                <img src="{{ asset('public') }}/dist/images/profile/user-1.jpg"
                                                    class="rounded-circle" width="35" height="35"
                                                    alt="" />
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                                        aria-labelledby="drop1">
                                        <div class="profile-dropdown position-relative" data-simplebar>
                                            <div class="py-3 px-7 pb-0">
                                                <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                                            </div>
                                            <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                                <img src="{{ asset('public') }}/dist/images/profile/user-1.jpg"
                                                    class="rounded-circle" width="80" height="80"
                                                    alt="" />
                                                <div class="ms-3">
                                                    <h5 class="mb-1 fs-3">{{ Auth::user()->name }}</h5>
                                                    <span
                                                        class="mb-1 d-block text-dark">{{ Auth::user()->role }}</span>
                                                    <p class="mb-0 d-flex text-dark align-items-center gap-2">
                                                        <i class="ti ti-mail fs-4"></i>{{ Auth::user()->email }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="message-body">
                                                <a href="{{ url('/profile-settings') }}"
                                                    class="py-8 px-7 mt-8 d-flex align-items-center">
                                                    <span
                                                        class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                                                        <img src="{{ asset('public') }}/dist/images/svgs/icon-account.svg"
                                                            alt="" width="24" height="24">
                                                    </span>
                                                    <div class="w-75 d-inline-block v-middle ps-3">
                                                        <h6 class="mb-1 bg-hover-primary fw-semibold"> My Profile </h6>
                                                        <span class="d-block text-dark">Account Settings</span>
                                                    </div>
                                                </a>


                                            </div>
                                            @if (session('admin'))
                                                <div class="d-grid py-2 px-7 pt-8">
                                                    <a href="javascript:void(0);"
                                                        onclick="window.location = '{{ url('Back-to-Admin') }}/{{ session('admin') }}'"
                                                        class="btn btn-outline-primary">Back to Admin</a>
                                                </div>
                                            @endif
                                            <div class="d-grid py-4 px-7 pt-8">
                                                <a href="javascript:void(0);"
                                                    onclick="document.getElementById('logoutForm').submit();"
                                                    class="btn btn-outline-primary">Log Out</a>
                                                <form id="logoutForm" method="POST" action="{{ url('/logout') }}">
                                                    @csrf</form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            @yield('content')
            <script src="{{ asset('public') }}/dist/libs/jquery/dist/jquery.min.js"></script>
            <script src="{{ asset('public') }}/dist/libs/simplebar/dist/simplebar.min.js"></script>
            <script src="{{ asset('public') }}/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

            <!-- ---------------------------------------------- -->
            <!-- core files -->
            <!-- ---------------------------------------------- -->
            <script src="{{ asset('public') }}/dist/js/app.min.js"></script>
            <script src="{{ asset('public') }}/dist/js/app.init.js"></script>
            <script src="{{ asset('public') }}/dist/js/app-style-switcher.js"></script>
            <script src="{{ asset('public') }}/dist/js/sidebarmenu.js"></script>

            <script src="{{ asset('public') }}/dist/js/custom.js"></script>
            <script src="{{ asset('public') }}/dist/libs/prismjs/prism.js"></script>

            <script src="{{ asset('public') }}/dist/libs/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="{{ asset('public') }}/dist/js/datatable/datatable-basic.init.js"></script>
            <!-- ---------------------------------------------- -->
            <script src="{{ asset('public') }}/dist/libs/select2/dist/js/select2.full.min.js"></script>
            <script src="{{ asset('public') }}/dist/libs/select2/dist/js/select2.min.js"></script>
            <script src="{{ asset('public') }}/dist/js/forms/select2.init.js"></script>
            <script src="{{ asset('public') }}/dist/libs/owl.carousel/dist/owl.carousel.min.js"></script>
            <script src="{{ asset('public') }}/dist/libs/apexcharts/dist/apexcharts.min.js"></script>
            <script src="{{ asset('public') }}/dist/js/dashboard.js"></script>
            <script src="{{ asset('public') }}/dist/libs/sweetalert2/dist/sweetalert2.min.js"></script>
            <script src="{{ asset('public') }}/dist/js/forms/sweet-alert.init.js"></script>
            <script src="{{ asset('public') }}/dist/libs/bootstrap-material-datetimepicker/node_modules/moment/moment.js"></script>
            <script src="{{ asset('public') }}/dist/libs/daterangepicker/daterangepicker.js"></script>
            <script src="{{ asset('public') }}/dist/libs/moment-js/moment.js"></script>
            <script src="{{ asset('public') }}/dist/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
            <script src="{{ asset('public') }}/dist/libs/pickadate-jalaali/lib/compressed/picker.js"></script>
            <script src="{{ asset('public') }}/dist/libs/pickadate-jalaali/lib/compressed/picker.date.js"></script>
            <script src="{{ asset('public') }}/dist/libs/pickadate-jalaali/lib/compressed/picker.time.js"></script>
            <script src="{{ asset('public') }}/dist/libs/pickadate-jalaali/lib/compressed/legacy.js"></script>
            <script src="{{ asset('public') }}/dist/libs/bootstrap-material-datetimepicker/node_modules/moment/moment.js"></script>
            <script src="{{ asset('public') }}/dist/libs/daterangepicker/daterangepicker.js"></script>
            <script src="{{ asset('public') }}/dist/js/plugins/datetimepicker.init.js"></script>
            @if (Session::has('success'))
                <script>
                    Swal.fire({
                        title: 'Success!',
                        text: '{{ Session::get('success') }}',
                        icon: 'success',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                </script>
            @elseif (Session::has('error'))
                <script>
                    Swal.fire({
                        title: 'Error!',
                        text: '{{ Session::get('error') }}',
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                </script>
            @endif
            @yield('javascript')
            <script type="text/javascript">
                $(".daterange").daterangepicker();
            </script>

</body>

</html>
