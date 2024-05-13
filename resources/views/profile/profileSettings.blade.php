@extends('layouts.dashboard')

@section('content')
    @php
        @$pool_data = DB::table('pool')
            ->where('id', @session('pool_select'))
            ->first();
    @endphp
    <div class="container-fluid mw-100">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">הגדרות</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted " href="{{ url('/Home') }}">דשבורד</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">פּרוֹפִיל</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <img src="{{ asset('public') }}/dist/images/breadcrumb/ChatBc.png" alt=""
                                class="img-fluid mb-n4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom d-flex justify-content-between">
                <h5 class="card-title fw-semibold mb-0 lh-sm">עריכת פרופיל</h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" class="container-fluid" action="{{ url('/profile-settings/update') }}"
                    enctype="multipart/form-data">@csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">שֵׁם</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ $user->name }}" name="name" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">אימייל</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ $user->email }}" name="email" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">טלפון</label>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ $user->phone }}" name="phone" id="exampleInputphone1"
                                    aria-describedby="phoneHelp">
                                @error('phone')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label for="file" class="form-label">תמונת פרופיל</label>
                                <input type="file" class="form-control @error('file') is-invalid @enderror"
                                    name="file" id="fileInput">
                                @error('file')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 d-flex align-items-center">
                            <div class="mb-3 ms-2">
                                <img src="{{ asset('public') }}/dist/images/profile/{{ $user->image }}"
                                    class="rounded-circle m-1" style="object-fit: cover" alt="No image" height="70"
                                    width="70">
                            </div>
                            <button type="button" data-url="{{ url('/Delete-image') }}"
                                class="btn btn-light-danger text-danger remove-img ms-2"><i
                                    class="ti ti-trash me-2"></i>להסיר תמונה</button>
                        </div>
                        @if (@$pool_data->mon_start_time != null && @$pool_data->mon_end_time != null)
                            <div class="row mb-3">
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <h5 class="fw-semibold me-3">שעון שני :</h5>
                                    <h5>{{ @$pool_data->mon_start_time }} - {{ @$pool_data->mon_end_time }}</h5>
                                </div>
                            </div>
                        @endif
                        @if (@$pool_data->tue_start_time != null && @$pool_data->tue_end_time != null)
                            <div class="row mb-3">
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <h5 class="fw-semibold me-3">זמן שלישי :</h5>
                                    <h5>{{ @$pool_data->tue_start_time }} - {{ @$pool_data->tue_end_time }}</h5>
                                </div>
                            </div>
                        @endif
                        @if (@$pool_data->wed_start_time != null && @$pool_data->wed_end_time != null)
                            <div class="row mb-3">
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <h5 class="fw-semibold me-3">זמן רביעי :</h5>
                                    <h5>{{ @$pool_data->wed_start_time }} - {{ @$pool_data->wed_end_time }}</h5>
                                </div>
                            </div>
                        @endif
                        @if (@$pool_data->thu_start_time != null && @$pool_data->thu_end_time != null)
                            <div class="row mb-3">
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <h5 class="fw-semibold me-3">זמן חמישי :</h5>
                                    <h5>{{ @$pool_data->thu_start_time }} - {{ @$pool_data->thu_end_time }}</h5>
                                </div>
                            </div>
                        @endif
                        @if (@$pool_data->fri_start_time != null && @$pool_data->fri_end_time != null)
                            <div class="row mb-3">
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <h5 class="fw-semibold me-3">זמן שישי :</h5>
                                    <h5>{{ @$pool_data->fri_start_time }} - {{ @$pool_data->fri_end_time }}</h5>
                                </div>
                            </div>
                        @endif
                        @if (@$pool_data->sat_start_time != null && @$pool_data->sat_end_time != null)
                            <div class="row mb-3">
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <h5 class="fw-semibold me-3">זמן שבת :</h5>
                                    <h5>{{ @$pool_data->sat_start_time }} - {{ @$pool_data->sat_end_time }}</h5>
                                </div>
                            </div>
                        @endif
                        @if (@$pool_data->sun_start_time != null && @$pool_data->sun_end_time != null)
                            <div class="row mb-3">
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <h5 class="fw-semibold me-3">זמן ראשון :</h5>
                                    <h5>{{ @$pool_data->sun_start_time }} - {{ @$pool_data->sun_end_time }}</h5>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-12 mb-4">
                            <button type="submit" class="btn btn-primary py-8  rounded-2">שמור שינויים</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom d-flex justify-content-between">
                <h5 class="card-title fw-semibold mb-0 lh-sm">ערוך סיסמה</h5>

            </div>
            <div class="card-body p-4">
                <form method="POST" class="container-fluid" action="{{ url('/profile-settings/update-password/') }}">
                    @csrf
                    <div class="row">


                        <div class="col-md-6 col-12 ">
                            <div class="mb-4">
                                <label for="exampleInputPassword1" class="form-label">סיסמה</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="exampleInputPassword1">
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12 ">
                            <div class="mb-4">
                                <label for="exampleInputPassword2" class="form-label">אימות סיסמה</label>
                                <input type="password"
                                    class="form-control @error('confirm_password') is-invalid @enderror"
                                    name="confirm_password" id="exampleInputPassword2">
                                @error('confirm_password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <button type="submit" class="btn btn-primary py-8  rounded-2">שמור שינויים</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        function setFileInputText() {
            var fileInput = document.getElementById('fileInput');
            if (fileInput) {
                fileInput.title = 'בחר קובץ'; // Change the button text here
                fileInput.placeholder = 'אין קובץ נבחר';
            }
        }

        setFileInputText();
        $('.remove-img').on('click', function() {
            var url = $(this).data('url');
            console.log(url);
            Swal.fire({
                title: "האם אתה בטוח?",
                text: "אתה לא תוכל להחזיר את זה!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "לְהַסִיר",
                cancelButtonText: "לְבַטֵל",
            }).then((result) => {
                if (result.value) {
                    window.location = url;
                }
            });
        })
    </script>
@endsection
