@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">עריכת בריכה</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted text-decoration-none"
                                        href="{{ url('/Pools') }}">
                                        בריכות</a></li>
                                <li class="breadcrumb-item" aria-current="page">עריכת בריכה</li>
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
                        <h5 class="card-title fw-semibold mb-0">עריכת בריכה</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/Pool/update/' . $pool_data->id) }}" id="jquery-val-form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-3 form-group">
                                    <label>שֵׁם</label>
                                    <input type="" placeholder="Enter Name" value="{{ $pool_data->name }}"
                                        name="name" class="form-control">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>טֵלֵפוֹן</label>
                                    <input type="" placeholder="Enter Telephone" value="{{ $pool_data->phone }}"
                                        name="phone" class="form-control">
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>אימייל</label>
                                    <input type="email" placeholder="Enter Email" value="{{ $pool_data->email }}"
                                        name="email" class="form-control">
                                </div>
                                <div class="col-lg-12"></div>
                                @php
                                    $paymentOptions = explode(', ', $pool_data->payments);
                                    $availble_days = explode(', ', $pool_data->availble_days);
                                @endphp
                                <div class="col-lg-3 form-group">
                                    <label>אפשרויות תשלום</label>
                                    <div class="mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input primary check-outline outline-primary"
                                                type="checkbox" name="payment_options[]" id="primary-outline-check"
                                                value="העברה בנקאית"
                                                {{ in_array('העברה בנקאית', $paymentOptions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="primary-outline-check">העברה בנקאית</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input primary check-outline outline-primary"
                                                type="checkbox" name="payment_options[]" id="primary2-outline-check"
                                                value="כרטיס אשראי"
                                                {{ in_array('כרטיס אשראי', $paymentOptions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="primary2-outline-check">כרטיס אשראי</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input primary check-outline outline-primary"
                                                type="checkbox" name="payment_options[]" id="primary3-outline-check"
                                                value="מזומן"
                                                {{ in_array('מזומן', $paymentOptions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="primary3-outline-check">מזומן</label>
                                        </div>
                                    </div>
                                    @error('payment_options')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>הודעות</label>
                                    <div class="mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input primary check-outline outline-primary"
                                                type="radio" name="sms" id="primary-outline-radio" value="Turn on"
                                                {{ $pool_data->messages == 'Turn on' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="primary-outline-radio">להדליק</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input primary check-outline outline-primary"
                                                type="radio" name="sms" id="primary2-outline-radio" value="Turn off"
                                                {{ $pool_data->messages == 'Turn off' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="primary2-outline-radio">לכבות</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12"></div>
                                <div class="col-lg-3 form-group bank-field">
                                    <label>שם הבנק</label>
                                    <input type="text" placeholder="הזן את שם הבנק" value="{{ $pool_data->bank_name }}"
                                        name="bank_name" class="form-control @error('bank_name') is-invalid @enderror">
                                    @error('bank_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-3 form-group bank-field">
                                    <label>מספר סניף</label>
                                    <input type="text" placeholder="הזן מספר סניף" value="{{ $pool_data->branch_number }}"
                                        name="branch_number"
                                        class="form-control @error('branch_number') is-invalid @enderror">
                                    @error('branch_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-3 form-group bank-field">
                                    <label>מספר חשבון.</label>
                                    <input type="text" placeholder="הזן מספר חשבון" value="{{ $pool_data->account_no }}"
                                        name="account_no" class="form-control @error('account_no') is-invalid @enderror">
                                    @error('account_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12"></div>
                                <h4 class="mb-3">ימים ושעה זמינים</h4>
                                <div class="row mb-3">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="sunday"
                                                name="sunday" value="Sunday"
                                                {{ in_array('Sunday', $availble_days) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="success-check">יוֹם רִאשׁוֹן</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">שעת התחלה</label>
                                        <input type="text" class="pickatime-formatTime-display form-control   "
                                            id="sun_start_time" name="sun_start_time"
                                            value="{{ $pool_data->sun_start_time ? date('H:i', strtotime($pool_data->sun_start_time)) : '' }}" />

                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">זמן סיום</label>
                                        <input type="text" class="pickatime-formatTime-display form-control r"
                                            id="sun_end_time" name="sun_end_time"
                                            value="{{ $pool_data->sun_end_time ? date('H:i', strtotime($pool_data->sun_end_time)) : '' }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3 ">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="monday"
                                                name="monday" value="Monday"
                                                {{ in_array('Monday', $availble_days) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="success-check">יוֹם שֵׁנִי</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3 ">
                                        <label for="password">שעת התחלה</label>
                                        <input type="text" class="form-control pickatime-formatTime-display"
                                            id="mon_start_time" name="mon_start_time"
                                            value="{{ $pool_data->mon_start_time ? date('H:i', strtotime($pool_data->mon_start_time)) : '' }}" />

                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">זמן סיום</label>
                                        <input type="text" class="form-control pickatime-formatTime-display"
                                            id="mon_end_time" name="mon_end_time"
                                            value="{{ $pool_data->mon_end_time ? date('H:i', strtotime($pool_data->mon_end_time)) : '' }}" />


                                    </div>


                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3 ">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="tuesday"
                                                name="tuesday" value="Tuesday"
                                                {{ in_array('Tuesday', $availble_days) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="success-check">יוֹם שְׁלִישִׁי</label>
                                        </div>
                                    </div>


                                    <div class="col-md-3 ">
                                        <label for="password">שעת התחלה</label>
                                        <input type="text" class="form-control  pickatime-formatTime-display "
                                            id="tue_start_time" name="tue_start_time"
                                            value="{{ $pool_data->tue_start_time ? date('H:i', strtotime($pool_data->tue_start_time)) : '' }}" />

                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">זמן סיום</label>
                                        <input type="text" class="form-control r pickatime-formatTime-display"
                                            id="tue_end_time" name="tue_end_time"
                                            value="{{ $pool_data->tue_end_time ? date('H:i', strtotime($pool_data->tue_end_time)) : '' }}" />


                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="wednesday"
                                                name="wednesday" value="Wednesday"
                                                {{ in_array('Wednesday', $availble_days) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="success-check">יום רביעי</label>
                                        </div>

                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">שעת התחלה</label>
                                        <input type="text" class="form-control  pickatime-formatTime-display "
                                            id="wed_start_time" name="wed_start_time"
                                            value="{{ $pool_data->wed_start_time ? date('H:i', strtotime($pool_data->wed_start_time)) : '' }}" />

                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">זמן סיום</label>
                                        <input type="text" class="pickatime-formatTime-display form-control r"
                                            id="wed_end_time" name="wed_end_time"
                                            value="{{ $pool_data->wed_end_time ? date('H:i', strtotime($pool_data->wed_end_time)) : '' }}" />


                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="thursday"
                                                name="thursday" value="Thursday"
                                                {{ in_array('Thursday', $availble_days) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="success-check">יוֹם חֲמִישִׁי</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">שעת התחלה</label>
                                        <input type="text" class="pickatime-formatTime-display form-control   "
                                            id="thu_start_time" name="thu_start_time"
                                            value="{{ $pool_data->thu_start_time ? date('H:i', strtotime($pool_data->thu_start_time)) : '' }}" />

                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">זמן סיום</label>
                                        <input type="text" class="pickatime-formatTime-display form-control r"
                                            id="thu_end_time" name="thu_end_time"
                                            value="{{ $pool_data->thu_end_time ? date('H:i', strtotime($pool_data->thu_end_time)) : '' }}" />


                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="friday"
                                                name="friday" value="Friday"
                                                {{ in_array('Friday', $availble_days) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="success-check">יוֹם שִׁישִׁי</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">שעת התחלה</label>
                                        <input type="text" class="pickatime-formatTime-display form-control   "
                                            id="fri_start_time" name="fri_start_time"
                                            value="{{ $pool_data->fri_start_time ? date('H:i', strtotime($pool_data->fri_start_time)) : '' }}" />

                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">זמן סיום</label>
                                        <input type="text" class="pickatime-formatTime-display form-control r"
                                            id="fri_end_time" name="fri_end_time"
                                            value="{{ $pool_data->fri_end_time ? date('H:i', strtotime($pool_data->fri_end_time)) : '' }}" />


                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="saturday"
                                                name="saturday" value="Saturday"
                                                {{ in_array('Saturday', $availble_days) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="success-check">יום שבת</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">שעת התחלה</label>
                                        <input type="text" class="pickatime-formatTime-display form-control   "
                                            id="sat_start_time" name="sat_start_time"
                                            value="{{ $pool_data->sat_start_time ? date('H:i', strtotime($pool_data->sat_start_time)) : '' }}" />

                                    </div>
                                    <div class="col-md-3 ">
                                        <label for="password">זמן סיום</label>
                                        <input type="text" class="pickatime-formatTime-display form-control r"
                                            id="sat_end_time" name="sat_end_time"
                                            value="{{ $pool_data->sat_end_time ? date('H:i', strtotime($pool_data->sat_end_time)) : '' }}" />


                                    </div>

                                </div>
                                <div class="col-lg-4">
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
        $(".pickatime-formatTime-display").pickatime({
            format: "H:i",
            formatLabel: "<b>H</b>:i",
            formatSubmit: "HH:i",
            hiddenPrefix: "prefix__",
            hiddenSuffix: "__suffix"
        });

        $(".pickatime-formatTime-display2").pickatime({
            format: "H:i",
            formatLabel: "<b>H</b>:i",
            formatSubmit: "HH:i",
            hiddenPrefix: "prefix__",
            hiddenSuffix: "__suffix"
        });
        $('#primary-outline-check').on('change', function() {
            if ($(this).prop('checked')) {
                $('.bank-field').removeClass('d-none');
            } else {
                $('.bank-field').addClass('d-none');
            }
        });
        $('#primary-outline-check').change();
    </script>
@endsection
