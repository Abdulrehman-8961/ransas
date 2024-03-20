@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Add User</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted text-decoration-none"
                                        href="{{ url('/Users') }}">
                                        Users</a></li>
                                <li class="breadcrumb-item" aria-current="page">Add User</li>
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
                        <h5 class="card-title fw-semibold mb-0">Add User</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/User/save') }}" id="jquery-val-form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 form-group">
                                    <label>Name</label>
                                    <input type="" placeholder="Enter Name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>Telephone</label>
                                    <input type="" placeholder="Enter Telephone Name" value="{{ old('phone') }}"
                                        name="phone" class="form-control @error('phone') is-invalid @enderror">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>Email</label>
                                    <input type="email" placeholder="Enter Email" value="{{ old('email') }}"
                                        name="email" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12"></div>
                                <div class="col-lg-4 form-group">
                                    <label>Role</label>
                                    <select type="" placeholder="Enter Role" id="role" name="role"
                                        class="form-control @error('role') is-invalid @enderror">
                                        <option value="Staff" {{ old('role') == 'Staff' ? 'selected' : '' }}>Staff</option>
                                        <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>Permissions</label>
                                    <select type="" placeholder="Enter Permission" id="permission" name="permission"
                                        class="form-control @error('permission') is-invalid @enderror">
                                        <option value="Readonly" {{ old('permission') == 'Readonly' ? 'selected' : '' }}>
                                            Readonly</option>
                                        <option value="Edit" {{ old('permission') == 'Edit' ? 'selected' : '' }}>Edit
                                        </option>

                                    </select>
                                    @error('permission')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @php
                                    $pool = DB::table('users')->where('role','Pool')->get();
                                @endphp
                                <div class="col-lg-4 form-group">
                                    <label>Pool</label>
                                    <select id="pool" name="pool"
                                        class="form-control @error('pool') is-invalid @enderror">
                                        <option value=""></option>
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
                                    <label>Password</label>
                                    <input type="password" placeholder="Enter Password" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" placeholder="Enter Confirm Password" name="confirm_password"
                                        class="form-control">
                                </div>
                                <div class="col-lg-12"></div>
                                <div class="col-lg-4 mt-3">
                                    <button class="btn btn-primary" name="submit" type="submit">Save</button>
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
