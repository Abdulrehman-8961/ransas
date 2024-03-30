@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid mw-100">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">הגדרות</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted " href="{{ url('/Home') }}">לוּחַ מַחווָנִים</a>
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
                <h5 class="card-title fw-semibold mb-0 lh-sm">לַעֲרוֹך</h5>

            </div>
            <div class="card-body p-4">
                <form method="POST" class="container-fluid" action="{{ url('/profile-settings/update') }}" enctype="multipart/form-data">@csrf
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
                                <input type="file" class="form-control @error('file') is-invalid @enderror" name="file">
                                @error('file')
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
