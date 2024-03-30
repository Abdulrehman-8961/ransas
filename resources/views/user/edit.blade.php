@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">ערוך משתמש</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted text-decoration-none"
                                        href="{{ url('/Users') }}">
                                        משתמשים</a></li>
                                <li class="breadcrumb-item" aria-current="page">ערוך משתמש</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <img src="dist/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="px-4 py-3 border-bottom">
                        <h5 class="card-title fw-semibold mb-0">ערוך משתמש</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/User/update/' . $user->id) }}" id="jquery-val-form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label>שֵׁם</label>
                                    <input type="" placeholder="הכנס שם" value="{{ $user->name }}"
                                        name="name" class="form-control">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>טֵלֵפוֹן</label>
                                    <input type="" placeholder="הזן מספר טלפון" value="{{ $user->phone }}"
                                        name="phone" class="form-control">
                                </div>
                                <div class="col-lg-12"></div>
                                <div class="col-lg-6 form-group">
                                    <label>אימייל</label>
                                    <input type="email" placeholder="הזן אימייל" value="{{ $user->email }}"
                                        name="email" class="form-control">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>תַפְקִיד</label>
                                    <select type="" placeholder="Enter Role" id="role" name="role"
                                        class="form-control">
                                        <option value="Staff" {{ $user->role == 'Staff' ? 'selected' : '' }}>Staff</option>
                                        <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>

                                    </select>
                                </div>
                                <div class="col-lg-6 form-group @if ($user->role == 'Admin') d-none @endif">
                                    <label>הרשאות</label>
                                    <select type="" placeholder="Enter Role" id="permission" name="permission"
                                        class="form-control">
                                        <option value="Readonly" {{ $user->permission == 'Readonly' ? 'selected' : '' }}>
                                            לקריאה בלבד
                                        </option>
                                        <option value="Edit" {{ $user->permission == 'Edit' ? 'selected' : '' }}>לַעֲרוֹך
                                        </option>
                                    </select>
                                </div>
                                @php
                                    $pool = DB::table('pool')->where('is_deleted',0)->get();
                                    $pool_ids = explode(', ', $user->pool_id);
                                @endphp
                                <div class="col-lg-6 form-group">
                                    <label>בריכה</label>
                                    <select id="pool" name="pool[]"
                                        class="form-control select2 @error('pool') is-invalid @enderror" multiple="multiple">
                                        <option value=""></option>
                                        @foreach ($pool as $p)
                                        <option value="{{ $p->id }}" {{ in_array($p->id, $pool_ids) ? 'selected' : '' }}>
                                            {{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('pool')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                <div class="col-lg-12"></div>
                                <div class="col-lg-4">
                                    <button class="btn btn-primary" name="submit" type="submit">להציל</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="px-4 py-3 border-bottom">
                        <h5 class="card-title fw-semibold mb-0">שנה סיסמא</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/User/update-password/' . $user->id) }}" id="jquery-val-form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label>סיסמה</label>
                                    <input type="password" placeholder="Enter Password" id="password" name="password"
                                        class="form-control">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>אשר סיסמה</label>
                                    <input type="password" placeholder="Enter Confirm Password" name="confirm_password"
                                        class="form-control">
                                </div>
                                <div class="col-lg-12"></div>
                                <div class="col-lg-4">
                                    <button class="btn btn-primary" name="submit1" type="submit">שינוי</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@section('javascript')
    <script>
        $(document).on('change', '#role', function() {
            var role = $('#role option:selected').val();
            if (role == 'Admin') {
                $('#permission').parent().addClass('d-none');
            } else {
                $('#permission').parent().removeClass('d-none');
            }
        })
    </script>
@endsection
