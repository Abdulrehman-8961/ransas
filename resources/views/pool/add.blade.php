@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Add Pool</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted text-decoration-none"
                                        href="{{ url('/Pools') }}">
                                        Pools</a></li>
                                <li class="breadcrumb-item" aria-current="page">Add Pool</li>
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
                        <h5 class="card-title fw-semibold mb-0">Add Pool</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/Pool/save') }}" id="jquery-val-form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-3 form-group">
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
                                <div class="col-lg-3 form-group">
                                    <label>Telephone</label>
                                    <input type="number" placeholder="Enter Telephone Name" value="{{ old('phone') }}"
                                        name="phone" class="form-control @error('phone') is-invalid @enderror">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>Email</label>
                                    <input type="email" placeholder="Enter Email" value="{{ old('email') }}"
                                        name="email" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 form-group">
                                    <label>Start Time</label>
                                    <input type="text" class="form-control pickatime-formatTime-display"
                                        placeholder="Time Format" value="{{ old('start_time') }}" name="start_time"
                                        id="start_time" />
                                    @error('start_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>End Time</label>
                                    <input type="text" class="form-control pickatime-formatTime-display"
                                        placeholder="Time Format" value="{{ old('end_time') }}" name="end_time"
                                        id="end_time" />
                                    @error('end_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 form-group">
                                    <label>Payment Options</label>
                                    <div class="mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input primary check-outline outline-primary"
                                                type="checkbox" name="payment_options[]" id="primary-outline-check"
                                                value="Bank transfer" {{ old('payment_options') == "Bank transfer" ? "checked" : "" }}>
                                            <label class="form-check-label" for="primary-outline-check">Bank
                                                transfer</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input primary check-outline outline-primary"
                                                type="checkbox" name="payment_options[]" id="primary2-outline-check"
                                                value="Credit Card" {{ old('payment_options') == "Credit Card" ? "checked" : "" }}>
                                            <label class="form-check-label" for="primary2-outline-check">Credit Card</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input primary check-outline outline-primary"
                                                type="checkbox" name="payment_options[]" id="primary3-outline-check"
                                                value="Cash" {{ old('payment_options') == "Cash" ? "checked" : "" }}>
                                            <label class="form-check-label" for="primary3-outline-check">Cash</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>Messages</label>
                                    <div class="mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input primary check-outline outline-primary"
                                                type="radio" name="sms" id="primary-outline-radio"
                                                value="Turn on" {{ old('sms') == "Turn on" ? "checked" : "" }}>
                                            <label class="form-check-label" for="primary-outline-radio">Turn on</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input primary check-outline outline-primary"
                                                type="radio" name="sms" id="primary2-outline-radio"
                                                value="Turn off" {{ old('sms') == "Turn off" ? "checked" : "" }}>
                                            <label class="form-check-label" for="primary2-outline-radio">Turn off</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
        $(".pickatime-formatTime-display").pickatime({
            format: "h:i a",
            formatLabel: "<b>h</b>:i <!i>a</!i>",
            formatSubmit: "HH:i",
            hiddenPrefix: "prefix__",
            hiddenSuffix: "__suffix",
        });
    </script>
@endsection
