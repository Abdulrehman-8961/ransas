@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Edit Pool</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted text-decoration-none"
                                        href="{{ url('/Pools') }}">
                                        Pools</a></li>
                                <li class="breadcrumb-item" aria-current="page">Edit Pool</li>
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
            <div class="col-12">
                <div class="card">
                    <div class="px-4 py-3 border-bottom">
                        <h5 class="card-title fw-semibold mb-0">Edit Pool</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/Pool/update/' . $pool_data->id) }}" id="jquery-val-form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 form-group">
                                    <label>Name</label>
                                    <input type="" placeholder="Enter Name" value="{{ $pool_data->name }}"
                                        name="name" class="form-control">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>Telephone</label>
                                    <input type="" placeholder="Enter Telephone" value="{{ $pool_data->phone }}"
                                        name="phone" class="form-control">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>Email</label>
                                    <input type="email" placeholder="Enter Email" value="{{ $pool_data->email }}"
                                        name="email" class="form-control">
                                </div>
                                <div class="col-lg-12"></div>
                                @php
                                    $paymentOptions = explode(', ', $pool_data->payments);
                                    $availble_days = explode(', ', $pool_data->availble_days);
                                @endphp
                                <div class="col-lg-4 form-group">
                                    <label>Payment Options</label>
                                    <div class="mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input primary check-outline outline-primary"
                                                type="checkbox" name="payment_options[]" id="primary-outline-check"
                                                value="Bank transfer"
                                                {{ in_array('Bank transfer', $paymentOptions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="primary-outline-check">Bank
                                                transfer</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input primary check-outline outline-primary"
                                                type="checkbox" name="payment_options[]" id="primary2-outline-check"
                                                value="Credit Card"
                                                {{ in_array('Credit Card', $paymentOptions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="primary2-outline-check">Credit Card</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input primary check-outline outline-primary"
                                                type="checkbox" name="payment_options[]" id="primary3-outline-check"
                                                value="Cash" {{ in_array('Cash', $paymentOptions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="primary3-outline-check">Cash</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>Messages</label>
                                    <div class="mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input primary check-outline outline-primary"
                                                type="radio" name="sms" id="primary-outline-radio" value="Turn on"
                                                {{ $pool_data->messages == 'Turn on' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="primary-outline-radio">Turn on</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input primary check-outline outline-primary"
                                                type="radio" name="sms" id="primary2-outline-radio" value="Turn off"
                                                {{ $pool_data->messages == 'Turn off' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="primary2-outline-radio">Turn off</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12"></div>
                                <h4 class="mb-3">Available Days & Time</h4>
                                <div class="row mb-3">
                                    <div class="col-md-3 ">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="monday" name="monday"
                                                value="Monday" {{ in_array('Monday', $availble_days) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="success-check">Monday</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3 ">
                                        <label for="password">Start Time</label>
                                        <input type="text" class="form-control pickatime-formatTime-display"
                                            id="mon_start_time" name="mon_start_time"
                                            value="{{ $pool_data->mon_start_time?date('h:i a', strtotime($pool_data->mon_start_time)):'' }}" />

                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">End Time</label>
                                        <input type="text" class="form-control pickatime-formatTime-display"
                                            id="mon_end_time" name="mon_end_time"
                                            value="{{ $pool_data->mon_end_time?date('h:i a', strtotime($pool_data->mon_end_time)):'' }}" />


                                    </div>


                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3 ">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="tuesday"
                                                name="tuesday" value="Tuesday" {{ in_array('Tuesday', $availble_days) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="success-check">Tuesday</label>
                                        </div>
                                    </div>


                                    <div class="col-md-3 ">
                                        <label for="password">Start Time</label>
                                        <input type="text" class="form-control  pickatime-formatTime-display "
                                            id="tue_start_time" name="tue_start_time"
                                            value="{{ $pool_data->tue_start_time?date('h:i a', strtotime($pool_data->tue_start_time)):'' }}" />

                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">End Time</label>
                                        <input type="text" class="form-control r pickatime-formatTime-display"
                                            id="tue_end_time" name="tue_end_time"
                                            value="{{ $pool_data->tue_end_time?date('h:i a', strtotime($pool_data->tue_end_time)):'' }}" />


                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="wednesday"
                                                name="wednesday" value="Wednesday" {{ in_array('Wednesday', $availble_days) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="success-check">Wednesday</label>
                                        </div>

                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">Start Time</label>
                                        <input type="text" class="form-control  pickatime-formatTime-display "
                                            id="wed_start_time" name="wed_start_time"
                                            value="{{ $pool_data->wed_start_time?date('h:i a', strtotime($pool_data->wed_start_time)):'' }}" />

                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">End Time</label>
                                        <input type="text" class="pickatime-formatTime-display form-control r"
                                            id="wed_end_time" name="wed_end_time"
                                            value="{{ $pool_data->wed_end_time?date('h:i a', strtotime($pool_data->wed_end_time)):"" }}" />


                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="thursday"
                                                name="thursday" value="Thursday" {{ in_array('Thursday', $availble_days) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="success-check">Thursday</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">Start Time</label>
                                        <input type="text" class="pickatime-formatTime-display form-control   "
                                            id="thur_start_time" name="thur_start_time"
                                            value="{{ $pool_data->thur_start_time?date('h:i a', strtotime($pool_data->thur_start_time)):'' }}" />

                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">End Time</label>
                                        <input type="text" class="pickatime-formatTime-display form-control r"
                                            id="thur_end_time" name="thur_end_time"
                                            value="{{ $pool_data->thur_end_time?date('h:i a', strtotime($pool_data->thur_end_time)):'' }}" />


                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="friday"
                                                name="friday" value="Friday" {{ in_array('Friday', $availble_days) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="success-check">Friday</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">Start Time</label>
                                        <input type="text" class="pickatime-formatTime-display form-control   "
                                            id="fri_start_time" name="fri_start_time"
                                            value="{{ $pool_data->fri_start_time?date('h:i a', strtotime($pool_data->fri_start_time)):'' }}" />

                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">End Time</label>
                                        <input type="text" class="pickatime-formatTime-display form-control r"
                                            id="fri_end_time" name="fri_end_time"
                                            value="{{ $pool_data->fri_end_time?date('h:i a', strtotime($pool_data->fri_end_time)):'' }}" />


                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="saturday"
                                                name="saturday" value="Saturday" {{ in_array('Saturday', $availble_days) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="success-check">Saturday</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">Start Time</label>
                                        <input type="text" class="pickatime-formatTime-display form-control   "
                                            id="sat_start_time" name="sat_start_time"
                                            value="{{ $pool_data->sat_start_time?date('h:i a', strtotime($pool_data->sat_start_time)):'' }}" />

                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">End Time</label>
                                        <input type="text" class="pickatime-formatTime-display form-control r"
                                            id="sat_end_time" name="sat_end_time"
                                            value="{{ $pool_data->sat_end_time?date('h:i a', strtotime($pool_data->sat_end_time)):'' }}" />


                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="sunday"
                                                name="sunday" value="Sunday" {{ in_array('Sunday', $availble_days) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="success-check">Sunday</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">Start Time</label>
                                        <input type="text" class="pickatime-formatTime-display form-control   "
                                            id="sun_start_time" name="sun_start_time"
                                            value="{{ $pool_data->sun_start_time?date('h:i a', strtotime($pool_data->sun_start_time)):'' }}" />

                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">End Time</label>
                                        <input type="text" class="pickatime-formatTime-display form-control r"
                                            id="sun_end_time" name="sun_end_time"
                                            value="{{ $pool_data->sun_end_time?date('h:i a', strtotime($pool_data->sun_end_time)):'' }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
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
            hiddenSuffix: "__suffix"
        });

        $(".pickatime-formatTime-display2").pickatime({
            format: "h:i a",
            formatLabel: "<b>h</b>:i <!i>a</!i>",
            formatSubmit: "HH:i",
            hiddenPrefix: "prefix__",
            hiddenSuffix: "__suffix"
        });
    </script>
@endsection
