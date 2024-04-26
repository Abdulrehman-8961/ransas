@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">הוסף משתמש</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted text-decoration-none"
                                        href="{{ url('/Users') }}">
                                        משתמשים</a></li>
                                <li class="breadcrumb-item" aria-current="page">הוסף משתמש</li>
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="px-4 py-3 border-bottom">
                        <h5 class="card-title fw-semibold mb-0">הוסף משתמש</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/User/save') }}" id="jquery-val-form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 form-group">
                                    <label>שֵׁם</label>
                                    <input type="" placeholder="הכנס שם" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>טֵלֵפוֹן</label>
                                    <input type="" placeholder="הזן מספר טלפון" value="{{ old('phone') }}"
                                        name="phone" class="form-control @error('phone') is-invalid @enderror">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>אימייל</label>
                                    <input type="email" placeholder="הזן אימייל" value="{{ old('email') }}"
                                        name="email" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12"></div>
                                <div class="col-lg-4 form-group">
                                    <label>תַפְקִיד</label>
                                    <select type="" placeholder="Enter Role" id="role" name="role"
                                        class="form-control @error('role') is-invalid @enderror">
                                        <option value="Staff" {{ old('role') == 'Staff' ? 'selected' : '' }}>צוות</option>
                                        <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>אדמין</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>הרשאות</label>
                                    <select id="permission" name="permission"
                                        class="form-control @error('permission') is-invalid @enderror">
                                        <option value="Readonly" {{ old('permission') == 'Readonly' ? 'selected' : '' }}>
                                            לקריאה בלבד</option>
                                        <option value="Edit" {{ old('permission') == 'Edit' ? 'selected' : '' }}>לַעֲרוֹך
                                        </option>

                                    </select>
                                    @error('permission')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @php
                                    $pool = DB::table('pool')->where('is_deleted',0)->get();
                                @endphp
                                <div class="col-lg-4 form-group">
                                    <label>בריכה</label>
                                    <select id="pool" name="pool[]"
                                        class="form-control select2 @error('pool') is-invalid @enderror" multiple="multiple">
                                        <option value="" disabled>בחר בריכה</option>
                                        @foreach ($pool as $p)
                                        <option value="{{ $p->id }}" {{ old('pool') == $p->id ? 'selected' : '' }}>
                                            {{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('pool')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>סיסמה</label>
                                    <input type="password" placeholder="הזן את הסיסמה" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>אשר סיסמה</label>
                                    <input type="password" placeholder="הזן אישור סיסמה" name="confirm_password"
                                        class="form-control">
                                </div>
                                <div class="col-lg-12"></div>
                                <div class="col-lg-4 mt-3 אישור">
                                    <button class="btn btn-primary" name="submit" type="submit">שלח</button>
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
                $('#pool').parent().addClass('d-none');
            } else {
                $('#permission').parent().removeClass('d-none');
                $('#pool').parent().removeClass('d-none');
            }
        })
    </script>
@endsection
