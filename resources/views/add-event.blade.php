@extends('layouts.dashboard')

@section('content')
    @php
        $user = DB::table('users')
            ->where('id', Auth::user()->id)
            ->first();
        $poolIDs = explode(', ', $user->pool_id);
        $pool_option = DB::table('pool')->wherein('id', $poolIDs)->where('is_deleted', 0)->get();
        $event = DB::table('events')
            ->where('id', @$_GET['event'])
            ->wherein('pool_id', $poolIDs)
            ->where('is_deleted', 0)
            ->first();
    @endphp
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Add Event</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted text-decoration-none"
                                        href="{{ url('/Home') }}">Events</a></li>
                                <li class="breadcrumb-item" aria-current="page">Add Event</li>
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



        <div class="card">
            <div class="card-body">
                <h5 class="mb-4">Add Event</h5>
                <form class="form" action="{{ url('Event/save') }}" method="POST">
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Select Pool</label>
                        <div class="col-md-10">
                            <select class="form-control @error('pool_select') is-invalid @enderror" name="pool_select"
                                id="pool_select">
                                <option value="">Select Pool</option>
                                @foreach ($pool_option as $row)
                                    <option value="{{ $row->id }}"
                                        {{ @$event->booking_type || old('pool_select') == $row->id ? 'selected' : '' }}>
                                        {{ $row->name }}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @csrf
                    <input type="hidden" id="parent_id" name="parent_id" value="0">
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Type</label>
                        <div class="col-md-10">
                            <select class="form-control @error('type') is-invalid @enderror" type="text" name="type"
                                id="type">
                                <option value="">Select Type</option>
                                <option value="Swimming Course"
                                    {{ @$event->booking_type || old('type') == 'Swimming Course' ? 'selected' : '' }}>
                                    Swimming Course</option>
                                <option value="Birthday"
                                    {{ @$event->booking_type || old('type') == 'Birthday' ? 'selected' : '' }}>Birthday
                                </option>
                                <option value="Private event" {{ old('type') == 'Private event' ? 'selected' : '' }}>Private
                                    event</option>
                                <option value="Other"
                                    {{ @$event->booking_type || old('type') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="example-search-input" class="col-md-2 col-form-label">Customer Name</label>
                        <div class="col-md-10">
                            <input class="form-control  @error('customer_name') is-invalid @enderror" name="customer_name"
                                type="" id="example-search-input"
                                value="{{ $event ? $event->customer_name : old('customer_name') }}">
                            @error('customer_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="example-email-input" class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-10">
                            <input class="form-control  @error('customer_email') is-invalid @enderror" type="email"
                                name="customer_email" placeholder="example@example.com" id="example-email-input"
                                value="{{ $event ? $event->customer_email : old('customer_email') }}">
                            @error('customer_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-search-input" class="col-md-2 col-form-label">Phone</label>
                        <div class="col-md-10">
                            <input class="form-control @error('customer_phone') is-invalid @enderror" type="number"
                                name="customer_phone" id="example-search-input"
                                value="{{ $event ? $event->customer_phone : old('customer_phone') }}">
                            @error('customer_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-datetime-local-input" class="col-md-2 col-form-label">Start Date and
                            time</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control datepicker-autoclose" id="start_date"
                                placeholder="mm/dd/yyyy" name="start_date" value="{{ old('start_date') }}" disabled/>
                            @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control pickatime-formatTime-display"
                                placeholder="Time Format" name="start_time" id="start_time"
                                value="{{ old('start_time') }}" @if(@$_GET['event'])  @else disabled @endif/>
                            @error('start_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="example-datetime-local-input" class="col-md-2 col-form-label">End Date and
                            time</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control datepicker-autoclose2" id="end_date"
                                placeholder="mm/dd/yyyy" name="end_date" value="{{ old('end_date') }}" disabled/>
                            <span class="invalid-feedback time-slot d-none" role="alert"><strong>This time slot is
                                    booked.</strong></span>
                            @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control pickatime-formatTime-display2"
                                placeholder="Time Format" value="{{ old('end_time') }}" name="end_time"
                                id="end_time" @if(@$_GET['event'])  @else disabled @endif/>
                            @error('end_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row d-none percentage-field">
                        <label for="example-search-input" class="col-md-2 col-form-label">Percentage Value</label>
                        <div class="col-md-10">
                            <select class="form-control" name="percentage_value" id="percentage_value">
                                <option value="">Select value</option>
                                <option value="25"
                                    {{ @$event->percentage_value || old('percentage_value') == '25' ? 'selected' : '' }}>
                                    25%
                                </option>
                                <option value="50"
                                    {{ @$event->percentage_value || old('percentage_value') == '50' ? 'selected' : '' }}>
                                    50%
                                </option>
                                <option value="75"
                                    {{ @$event->percentage_value || old('percentage_value') == '75' ? 'selected' : '' }}>
                                    75%
                                </option>
                                <option value="100"
                                    {{ @$event->percentage_value || old('percentage_value') == '100' ? 'selected' : '' }}>
                                    100%
                                </option>
                            </select>
                            @error('percentage_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="example-datetime-local-input" class="col-md-2 col-form-label">Total Payment</label>
                        <div class="col-md-10">
                            <input class="form-control  @error('total_payment') is-invalid @enderror" type="number"
                                value="{{ $event ? $event->total_payment : old('total_payment') }}" name="total_payment"
                                id="example-datetime-local-input">
                            @error('total_payment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Payment Method</label>
                        <div class="col-md-10">
                            <select class="form-control @error('payment_method') is-invalid @enderror" value=""
                                name="payment_method" id="payment_method">

                            </select>
                            @error('payment_method')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Payment Status</label>
                        <div class="col-md-10">
                            <select class="form-control @error('payment_status') is-invalid @enderror"
                                name="payment_status" id="example-text-input">
                                <option value="">Select Payment Status</option>
                                <option value="Paid"
                                    {{ @$event->payment_status || old('payment_status') == 'Paid' ? 'selected' : '' }}>Paid
                                </option>
                                <option value="Not Paid"
                                    {{ @$event->payment_status || old('payment_status') == 'Not Paid' ? 'selected' : '' }}>
                                    Not
                                    Paid</option>
                                <option value="On Hold"
                                    {{ @$event->payment_status || old('payment_status') == 'On Hold' ? 'selected' : '' }}>
                                    On Hold
                                </option>
                            </select>
                            @error('payment_status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-4">
                        <label class="col-md-2 col-form-label">Event Color</label>
                        <div class="d-flex col-md-10">
                            <div class="n-chk">
                                <div class="form-check form-check-primary form-check-inline">
                                    <input class="form-check-input danger check-light-danger" type="radio"
                                        name="event_level" value="Danger" id="modalDanger"
                                        {{ @$event->color || old('event_level') == 'Danger' ? 'checked' : '' }} />
                                    <label class="form-check-label" for="modalDanger">Danger</label>
                                </div>
                            </div>
                            <div class="n-chk">
                                <div class="form-check form-check-warning form-check-inline">
                                    <input class="form-check-input success check-light-success" type="radio"
                                        name="event_level" value="Success" id="modalSuccess"
                                        {{ @$event->color || old('event_level') == 'Success' ? 'checked' : '' }} />
                                    <label class="form-check-label" for="modalSuccess">Success</label>
                                </div>
                            </div>
                            <div class="n-chk">
                                <div class="form-check form-check-success form-check-inline">
                                    <input class="form-check-input primary check-light-primary" type="radio"
                                        name="event_level" value="Primary" id="modalPrimary"
                                        {{ @$event->color || old('event_level') == 'Primary' ? 'checked' : '' }} />
                                    <label class="form-check-label" for="modalPrimary">Primary</label>
                                </div>
                            </div>
                            <div class="n-chk">
                                <div class="form-check form-check-danger form-check-inline">
                                    <input class="form-check-input warning check-light-warning" type="radio"
                                        name="event_level" value="Warning" id="modalWarning"
                                        {{ @$event->color || old('event_level') == 'Warning' ? 'checked' : '' }} />
                                    <label class="form-check-label" for="modalWarning">Warning</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="d-flex col-md-10">
                            <div class="n-chk">
                                <div class="form-check form-check-success form-check-inline">
                                    <input class="form-check-input primary check-light-primary repeat" type="checkbox"
                                        name="repeat" value="repeat" id="repeat"
                                        {{ old('repeat') == 'repeat' ? 'checked' : '' }} />
                                    <label class="form-check-label" for="repeat">Repeat</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row d-none repeat-fields">
                        <label for="example-text-input" class="col-md-2 col-form-label">Repeat Cycle & Count</label>
                        <div class="col-md-7">
                            <select class="form-control @error('repeat_cycle') is-invalid @enderror" name="repeat_cycle"
                                id="example-text-input">
                                <option value="">Select Repeat Cycle</option>
                                <option value="Daily" {{ old('repeat_cycle') == 'Daily' ? 'selected' : '' }}>Daily
                                </option>
                                <option value="Weekly" {{ old('repeat_cycle') == 'Weekly' ? 'selected' : '' }}>Weekly
                                </option>
                                <option value="Monthly" {{ old('repeat_cycle') == 'Monthly' ? 'selected' : '' }}>Monthly
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control @error('repeat_count') is-invalid @enderror"
                                name="repeat_count" id="repeat_count" placeholder="Repeat Count">
                        </div>
                        @error('repeat_cycle')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-end mt-3">
                            <button type="submit" class="btn btn-info font-medium rounded-pill px-4 btn-submit" disabled>
                                <div class="d-flex align-items-center">
                                    <i class="ti ti-send me-2 fs-4"></i>
                                    Submit
                                </div>
                            </button>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div>


    </div>
    <input type="hidden" id="hidden_start_date" value="{{ @$event->start_date }}">
    <input type="hidden" id="hidden_end_date" value="{{ @$event->end_date }}">
    <input type="hidden" id="hidden_start_time" value="{{ @$event->start_time }}">
    <input type="hidden" id="hidden_end_time" value="{{ @$event->end_time }}">
@endsection

@section('javascript')
    <script>
        var start_date = $('#hidden_start_date').val();
        if (start_date) {
            var startDateParts = start_date.split('-');
            var formattedDateStart = `${startDateParts[1]}/${startDateParts[2]}/${startDateParts[0]}`;
            $(".pickatime-formatTime-display").pickatime({
                format: "H:i",
                formatLabel: "<b>H</b>:i",
                formatSubmit: "HH:i",
                hiddenPrefix: "prefix__",
                hiddenSuffix: "__suffix",
            }).pickatime('picker').set('select', '{{ date('H:i', strtotime(@$event->start_time)) }}');
            jQuery(".datepicker-autoclose").datepicker({
                autoclose: true,
                todayHighlight: true,
                startDate: new Date()
            }).datepicker('setDate', formattedDateStart).on('changeDate', function(selected) {
                var selectedDate = selected.date;

                // Format selected date as YYYY-MM-DD
                var formattedDate = selectedDate.getFullYear() + '-' +
                    ('0' + (selectedDate.getMonth() + 1)).slice(-2) + '-' +
                    ('0' + selectedDate.getDate()).slice(-2);

                // Make AJAX request to fetch available time slots for the selected date
                $.ajax({
                    type: "GET",
                    url: "{{ url('getAvailableTimeSlots') }}",
                    data: {
                        selected_date: formattedDate
                    },
                    success: function(response) {
                        if (response.success) {
                            $(".pickatime-formatTime-display").prop('disabled', false);
                            // Update the options of your time picker with the available time slots
                            var timePicker = $(".pickatime-formatTime-display").pickatime().pickatime(
                                'picker');
                            timePicker.set('disable', false); // Enable the time picker
                            timePicker.set('min', response.startTime); // Set the minimum time
                            timePicker.set('max', response.endTime); // Set the maximum time
                        } else {
                            console.error('Failed to fetch available time slots:', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to fetch available time slots:', error);
                    }
                });
            });
        } else {
            $(".pickatime-formatTime-display").pickatime({
                format: "H:i",
                formatLabel: "<b>H</b>:i",
                formatSubmit: "HH:i",
                hiddenPrefix: "prefix__",
                hiddenSuffix: "__suffix",
            });
            jQuery(".datepicker-autoclose").datepicker({
                autoclose: true,
                todayHighlight: true,
                startDate: new Date()
            }).on('changeDate', function(selected) {
                var selectedDate = selected.date;

                // Format selected date as YYYY-MM-DD
                var formattedDate = selectedDate.getFullYear() + '-' +
                    ('0' + (selectedDate.getMonth() + 1)).slice(-2) + '-' +
                    ('0' + selectedDate.getDate()).slice(-2);

                // Make AJAX request to fetch available time slots for the selected date
                $.ajax({
                    type: "GET",
                    url: "{{ url('getAvailableTimeSlots') }}",
                    data: {
                        selected_date: formattedDate
                    },
                    success: function(response) {
                        if (response.success) {
                            $(".pickatime-formatTime-display").prop('disabled', false);
                            // Update the options of your time picker with the available time slots
                            var timePicker = $(".pickatime-formatTime-display").pickatime().pickatime(
                                'picker');
                            timePicker.set('disable', false); // Enable the time picker
                            timePicker.set('min', response.startTime); // Set the minimum time
                            timePicker.set('max', response.endTime); // Set the maximum time
                        } else {
                            console.error('Failed to fetch available time slots:', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to fetch available time slots:', error);
                    }
                });
            });
        }
        var end_date = $('#hidden_end_date').val();
        if (end_date) {
            var endDateParts = end_date.split('-');
            var formattedDateEnd = `${endDateParts[1]}/${endDateParts[2]}/${endDateParts[0]}`;
            $(".pickatime-formatTime-display2").pickatime({
                format: "H:i",
                formatLabel: "<b>H</b>:i",
                formatSubmit: "HH:i",
                hiddenPrefix: "prefix__",
                hiddenSuffix: "__suffix",
            }).pickatime('picker').set('select', '{{ date('H:i', strtotime(@$event->end_time)) }}');
            jQuery(".datepicker-autoclose2").datepicker({
                autoclose: true,
                todayHighlight: true,
                startDate: new Date()
            }).datepicker('setDate', formattedDateEnd).on('changeDate', function(selected) {
                var selectedDate = selected.date;

                // Format selected date as YYYY-MM-DD
                var formattedDate = selectedDate.getFullYear() + '-' +
                    ('0' + (selectedDate.getMonth() + 1)).slice(-2) + '-' +
                    ('0' + selectedDate.getDate()).slice(-2);

                // Make AJAX request to fetch available time slots for the selected date
                $.ajax({
                    type: "GET",
                    url: "{{ url('getAvailableTimeSlots') }}",
                    data: {
                        selected_date: formattedDate
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update the options of your time picker with the available time slots
                            var timePicker = $(".pickatime-formatTime-display2").pickatime().pickatime(
                                'picker');
                            timePicker.set('disable', false); // Enable the time picker
                            timePicker.set('min', response.startTime); // Set the minimum time
                            timePicker.set('max', response.endTime); // Set the maximum time
                        } else {
                            console.error('Failed to fetch available time slots:', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to fetch available time slots:', error);
                    }
                });
            });
        } else {
            $(".pickatime-formatTime-display2").pickatime({
                format: "H:i",
                formatLabel: "<b>H</b>:i",
                formatSubmit: "HH:i",
                hiddenPrefix: "prefix__",
                hiddenSuffix: "__suffix",
            });
            jQuery(".datepicker-autoclose2").datepicker({
                autoclose: true,
                todayHighlight: true,
                startDate: new Date()
            }).on('changeDate', function(selected) {
                var selectedDate = selected.date;

                // Format selected date as YYYY-MM-DD
                var formattedDate = selectedDate.getFullYear() + '-' +
                    ('0' + (selectedDate.getMonth() + 1)).slice(-2) + '-' +
                    ('0' + selectedDate.getDate()).slice(-2);

                // Make AJAX request to fetch available time slots for the selected date
                $.ajax({
                    type: "GET",
                    url: "{{ url('getAvailableTimeSlots') }}",
                    data: {
                        selected_date: formattedDate
                    },
                    success: function(response) {
                        if (response.success) {
                            $(".pickatime-formatTime-display2").prop('disabled', false);
                            // Update the options of your time picker with the available time slots
                            var timePicker = $(".pickatime-formatTime-display2").pickatime().pickatime(
                                'picker');
                            timePicker.set('disable', false); // Enable the time picker
                            timePicker.set('min', response.startTime); // Set the minimum time
                            timePicker.set('max', response.endTime); // Set the maximum time
                        } else {
                            console.error('Failed to fetch available time slots:', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to fetch available time slots:', error);
                    }
                });
            });

        }
        $(document).on('change', '.repeat', function() {
            if ($(this).prop('checked')) {
                $('.repeat-fields').removeClass('d-none');
            } else {
                $('.repeat-fields').addClass('d-none');
            }
        })
        $('#repeat').change();

        $('#pool_select').change(function() {
            var poolID = $(this).val();
            if (poolID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/getPaymentOptions') }}",
                    data: {
                        pool_id: poolID
                    },
                    success: function(response) {
                        if (response.success) {
                            $("#payment_method").empty();
                            $("#payment_method").append(response.options);
                            $('.btn-submit').prop('disabled', false);
                            $('.datepicker-autoclose').prop('disabled', false);
                            $('.datepicker-autoclose2').prop('disabled', false);
                        } else {
                            console.log('Error:', response.message);
                            $('.btn-submit').prop('disabled', true);
                        }
                    }
                });
                $.ajax({
                    type: "GET",
                    url: "{{ url('/getAvailableDays') }}",
                    data: {
                        pool_id: poolID
                    },
                    success: function(response) {
                        if (response.success) {
                            // Clear previous options and add new available days to datepicker
                            $(".datepicker-autoclose").datepicker('destroy');
                            $(".datepicker-autoclose").datepicker({
                                autoclose: true,
                                todayHighlight: true,
                                startDate: new Date(),
                                daysOfWeekDisabled: response.disabledDays
                            });
                            $(".datepicker-autoclose2").datepicker('destroy');
                            $(".datepicker-autoclose2").datepicker({
                                autoclose: true,
                                todayHighlight: true,
                                startDate: new Date(),
                                daysOfWeekDisabled: response.disabledDays
                            });
                        } else {
                            console.log('Error:', response.message);
                        }
                    }
                });
            } else {
                $("#otherSelect").empty();
            }
        });

        $('#pool_select').change();


        $("#otherSelect").on('change', function() {
            var date = $(this).datepicker('getDate');
            var day = date.getDay(); // get the day of the week

            $.ajax({
                type: "GET",
                url: "{{ url('/checkDayAvailability') }}",
                data: {
                    day: day
                },
                success: function(response) {
                    if (response.available) {
                        console.log('Day is available');
                    } else {
                        console.log('Day is not available');
                    }
                }
            });
        })


        $(document).on('change', '#end_time', function() {
            var parent_id = $('#parent_id').val();
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            var start_time = $('#start_time').val();
            var end_time = $('#end_time').val();
            var url = "{{ asset('') }}check-availablity";
            if (start_date) {
                // Assuming you have jQuery included in your project
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        parent_id: parent_id,
                        startDate: start_date,
                        startTime: start_time,
                        endTime: end_time,
                        endDate: end_date,
                    },
                    success: function(response) {
                        // console.log(response);
                        if (response.available == true) {
                            // Time slot is available
                            console.log('Time slot is available');
                            $('#start_date').removeClass('is-invalid');
                            $('#end_date').removeClass('is-invalid');
                            $('#start_time').removeClass('is-invalid');
                            $('#end_time').removeClass('is-invalid').after('');
                            $('.time-slot').addClass('d-none');

                        } else {
                            // Time slot is not available
                            console.log('Time slot is not available');
                            $('#start_date').addClass('is-invalid');
                            $('#end_date').addClass('is-invalid');
                            $('#start_time').addClass('is-invalid');
                            $('#end_time').addClass('is-invalid');

                            $('.time-slot').removeClass('d-none');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(error);
                    }
                });

            }
        })
        $(document).on('change', '#type', function() {
            var event_type = $('#type option:selected').val();
            if (event_type == "Swimming Course") {
                $('.percentage-field').removeClass('d-none');
            } else {
                $('.percentage-field').addClass('d-none');
            }
        })
    </script>
@endsection
