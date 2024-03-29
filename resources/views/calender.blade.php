@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <style type="text/css">
            .fc-timegrid-event .fc-event-time {

                color: black;
            }

            .fc-v-event .fc-event-title {
                color: black;
                font-weight: 600;
            }
        </style>
        <!--  Owl carousel -->
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Calendar</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted " href="{{ url('/Home') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    Calendar
                                </li>
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
        @php
            $user = DB::table('users')
                ->where('id', Auth::user()->id)
                ->first();
            $poolIDs = explode(', ', $user->pool_id);
            $pool_option = DB::table('pool')->wherein('id', $poolIDs)->where('is_deleted', 0)->get();
        @endphp
        <form id="myForm" action="{{ URL::current() }}" method="get">
            <div class="row container mb-5">
                <div class="col-md-4 col-12">
                    <label for="">Select Pool</label>
                    <select class="form-control" name="pool_select" id="pool_select_main">
                        @foreach ($pool_option as $row)
                            <option value="{{ $row->id }}" {{ @$_GET['pool_select'] == $row->id ? 'selected' : '' }}>
                                {{ $row->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
        <div class="card">
            <div>
                <div class="row gx-0">
                    <div class="col-lg-12">
                        <div class="p-4 calender-sidebar app-calendar">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $user = DB::table('users')
                ->where('id', Auth::user()->id)
                ->first();
            $poolIDs = explode(', ', $user->pool_id);
            $pool_option = DB::table('pool')->wherein('id', $poolIDs)->where('is_deleted', 0)->get();
        @endphp
        <!-- BEGIN MODAL -->
        <div id="eventModal" class="modal fade" tabindex="-1" aria-labelledby="bs-example-modal-md" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <form id="event-form" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
                                        <label class="form-label">Pool</label>
                                        <select class="form-control @error('type') is-invalid @enderror"
                                            value="Artisanal kale" name="pool_select" id="pool_select">
                                            <option value="">Select Pool</option>
                                            @foreach ($pool_option as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="">
                                        <label class="form-label">Event Title</label>
                                        <select class="form-control event-type @error('type') is-invalid @enderror"
                                            type="text" value="Artisanal kale" name="type" id="event-title">
                                            <option value="">Select Type</option>
                                            <option value="Swimming Course">
                                                Swimming Course</option>
                                            <option value="Birthday">Birthday</option>
                                            <option value="Private event">Private
                                                event</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="">
                                        <label class="form-label">Customer Name</label>
                                        <input class="form-control  @error('customer_name') is-invalid @enderror"
                                            name="customer_name" id="customer_name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="">
                                        <label class="form-label">Email</label>
                                        <input class="form-control  @error('customer_email') is-invalid @enderror"
                                            type="email" name="customer_email" placeholder="example@example.com"
                                            id="customer_email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="">
                                        <label class="form-label">Phone</label>
                                        <input class="form-control @error('customer_phone') is-invalid @enderror"
                                            type="number" name="customer_phone" id="customer_phone">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="">
                                        <label class="form-label">Start Date and Time</label>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <input type="text" class="form-control datepicker-autoclose"
                                                    id="start_date" placeholder="mm/dd/yyyy" name="start_date" />
                                                @error('start_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <input type="text" class="form-control pickatime-formatTime-display"
                                                    placeholder="Time Format" name="start_time" id="start_time"
                                                    value="{{ old('start_time') }}" />
                                                @error('start_time')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="">
                                        <label class="form-label">End Date and Time</label>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <input type="text" class="form-control datepicker-autoclose2"
                                                    id="end_date" placeholder="mm/dd/yyyy" name="end_date" />
                                                <span class="invalid-feedback time-slot d-none"
                                                    role="alert"><strong>This time slot is
                                                        booked.</strong></span>
                                                @error('end_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <input type="text" class="form-control pickatime-formatTime-display2"
                                                    placeholder="Time Format" value="{{ old('end_time') }}"
                                                    name="end_time" id="end_time" />
                                                @error('end_time')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 d-none percentage-field">
                                    <div class="">
                                        <label class="form-label">Percentage Value</label>
                                        <select class="form-control percentage_value" name="percentage_value"
                                            id="percentage_value">
                                            <option value="">Select value</option>
                                            <option value="25">25%</option>
                                            <option value="50">50%</option>
                                            <option value="75">75%</option>
                                            <option value="100">100%</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="">
                                        <label class="form-label">Total Payment</label>
                                        <input class="form-control  @error('total_payment') is-invalid @enderror"
                                            type="number" name="total_payment" id="total_payment">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="">
                                        <label class="form-label">Payment Method</label>
                                        <select class="form-control @error('payment_method') is-invalid @enderror"
                                            name="payment_method" id="payment_method">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="">
                                        <label class="form-label">Payment Status</label>
                                        <select class="form-control @error('payment_status') is-invalid @enderror"
                                            name="payment_status" id="payment_status">
                                            <option value="">Select Payment Status</option>
                                            <option value="Paid">Paid
                                            </option>
                                            <option value="Not Paid">Not
                                                Paid</option>
                                            <option value="On Hold">On Hold
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <div><label class="form-label">Event Color</label></div>
                                    <div class="d-flex">
                                        <div class="n-chk">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input" type="radio" name="event_level"
                                                    value="Danger" id="modalDanger" />
                                                <label class="form-check-label" for="modalDanger">Danger</label>
                                            </div>
                                        </div>
                                        <div class="n-chk">
                                            <div class="form-check form-check-warning form-check-inline">
                                                <input class="form-check-input" type="radio" name="event_level"
                                                    value="Success" id="modalSuccess" />
                                                <label class="form-check-label" for="modalSuccess">Success</label>
                                            </div>
                                        </div>
                                        <div class="n-chk">
                                            <div class="form-check form-check-success form-check-inline">
                                                <input class="form-check-input" type="radio" name="event_level"
                                                    value="Primary" id="modalPrimary" />
                                                <label class="form-check-label" for="modalPrimary">Primary</label>
                                            </div>
                                        </div>
                                        <div class="n-chk">
                                            <div class="form-check form-check-danger form-check-inline">
                                                <input class="form-check-input" type="radio" name="event_level"
                                                    value="Warning" id="modalWarning" />
                                                <label class="form-check-label" for="modalWarning">Warning</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-success btn-update-event" data-fc-event-public-id="">
                                Update changes
                            </button>
                            <a class="btn btn-primary btn-duplicate-event">
                                Duplicate Event
                            </a>
                            <button type="button" class="btn btn-primary btn-add-event">
                                Add Event
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- END MODAL -->
    </div>
    </div>
    </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('public') }}/dist/libs/fullcalendar/index.global.min.js"></script>
    <script type="text/javascript">
    var formattedDateStart = '';
    var formattedDateEnd = '';
        var selectElement = document.getElementById('pool_select_main');

        // Add change event listener
        selectElement.addEventListener('change', function() {
            // Submit the form when the select field changes
            document.getElementById('myForm').submit();
        });
        @if (!isset($_GET['pool_select']))
            document.getElementById('myForm').submit();
        @endif
        jQuery(".mydatepicker, #datepicker, .input-group.date").datepicker();
        jQuery("#date-range").datepicker({
            toggleActive: true,
        });
        jQuery("#datepicker-inline").datepicker({
            todayHighlight: true,
        });
        $(".pickatime-formatTime-display").pickatime({
            format: "H:i",
            formatLabel: "<b>H</b>:i",
            formatSubmit: "HH:i",
            hiddenPrefix: "prefix__",
            hiddenSuffix: "__suffix",
        });
        $(".pickatime-formatTime-display2").pickatime({
            format: "H:i",
            formatLabel: "<b>H</b>:i",
            formatSubmit: "HH:i",
            hiddenPrefix: "prefix__",
            hiddenSuffix: "__suffix",
        });
        /*========Calender Js=========*/
        /*==========================*/
        /*========Calender Js=========*/
        /*==========================*/

        document.addEventListener("DOMContentLoaded", function() {
            /*=================*/
            //  Calender Date variable
            /*=================*/
            var newDate = new Date();

            function getDynamicMonth() {
                getMonthValue = newDate.getMonth();
                _getUpdatedMonthValue = getMonthValue + 1;
                if (_getUpdatedMonthValue < 10) {
                    return `0${_getUpdatedMonthValue}`;
                } else {
                    return `${_getUpdatedMonthValue}`;
                }
            }
            /*=================*/
            // Calender Modal Elements
            /*=================*/
            var getModalTitleEl = document.querySelector("#event-title");
            var getModalStartDateEl = document.querySelector("#event-start-date");
            var getModalEndDateEl = document.querySelector("#event-end-date");
            var getModalAddBtnEl = document.querySelector(".btn-add-event");
            var getModalUpdateBtnEl = document.querySelector(".btn-update-event");
            var calendarsEvents = {
                Danger: "danger",
                Success: "success",
                Primary: "primary",
                Warning: "warning",
            };
            /*=====================*/
            // Calendar Elements and options
            /*=====================*/
            var calendarEl = document.querySelector("#calendar");
            var checkWidowWidth = function() {
                if (window.innerWidth <= 1199) {
                    return true;
                } else {
                    return false;
                }
            };
            var calendarHeaderToolbar = {
                left: "prev next AddEvent ExportCsv",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay",
            };
            var calendarEventsList = [

                {
                    groupId: "999",
                    id: 3,
                    title: "Birthday-Huzaifa Ahmed",
                    start: `${newDate.getFullYear()}-${getDynamicMonth()}-09T16:00:00`,
                    extendedProps: {
                        calendar: "Primary"
                    },
                },

                {
                    id: 5,
                    title: "Swimming Course-Sami",
                    start: `${newDate.getFullYear()}-${getDynamicMonth()}-06T13:00:00`,
                    end: `${newDate.getFullYear()}-${getDynamicMonth()}-06T17:00:00`,
                    extendedProps: {
                        calendar: "Danger"
                    },
                },

            ];
            /*=====================*/
            // Calendar Select fn.
            /*=====================*/
            var calendarSelect = function(info) {
                getModalAddBtnEl.style.display = "block";
                getModalUpdateBtnEl.style.display = "none";
                // myModal.show();
                getModalStartDateEl.value = info.startStr;
                getModalEndDateEl.value = info.endStr;
            };
            /*=====================*/
            // Calendar AddEvent fn.
            /*=====================*/
            var calendarAddEvent = function() {
                var currentDate = new Date();
                var dd = String(currentDate.getDate()).padStart(2, "0");
                var mm = String(currentDate.getMonth() + 1).padStart(2, "0"); //January is 0!
                var yyyy = currentDate.getFullYear();
                var combineDate = `${yyyy}-${mm}-${dd}T00:00:00`;
                getModalAddBtnEl.style.display = "block";
                getModalUpdateBtnEl.style.display = "none";
                // myModal.show();
                getModalStartDateEl.value = combineDate;
            };

            /*=====================*/
            // Calender Event Function
            /*=====================*/
            var calendarEventClick = function(info) {
                var eventObj = info.event;

                var update_id = eventObj.extendedProps.bookid,
                    date = eventObj.extendedProps.date_start,
                    pool = eventObj.extendedProps.pool,
                    end_date = eventObj.extendedProps.date_end,
                    start_time = eventObj.extendedProps.start_time,
                    end_time = eventObj.extendedProps.end_time,
                    customer_name = eventObj.extendedProps.customer_name,
                    customer_email = eventObj.extendedProps.customer_email,
                    customer_phone = eventObj.extendedProps.customer_phone,
                    intervalDays = eventObj.extendedProps.interval_Days,
                    intervalHours = eventObj.extendedProps.interval_Hours,
                    intervalMinutes = eventObj.extendedProps.interval_Minutes,
                    payment_status = eventObj.extendedProps.payment_status,
                    payment_method = eventObj.extendedProps.payment_method,
                    percentage_value = eventObj.extendedProps.percentage_value,
                    payment_options = eventObj.extendedProps.payment_options,
                    total_payment = eventObj.extendedProps.total_payment;


                if (eventObj.url) {
                    window.open(eventObj.url);

                    info.jsEvent.preventDefault();
                } else {
                    var eventId = info.event.id;
                    document.getElementById("event-form").action = 'Event-update/' + update_id;
                    $('.btn-duplicate-event').attr('href', '{{ url('/Add-Event') }}?event=' + update_id);
                    var getModalEventId = eventObj._def.publicId;
                    var getModalEventLevel = eventObj._def.extendedProps["calendar"];
                    var getModalCheckedRadioBtnEl = document.querySelector(
                        `input[value="${getModalEventLevel}"]`
                    );

                    getModalTitleEl.value = eventObj.title;
                    getModalCheckedRadioBtnEl.checked = true;
                    getModalUpdateBtnEl.setAttribute(
                        "data-fc-event-public-id",
                        getModalEventId
                    );
                    getModalAddBtnEl.style.display = "none";
                    getModalUpdateBtnEl.style.display = "block";
                    $('#customer_name').val(customer_name);
                    $('#pool_select').val(pool);
                    $('#customer_email').val(customer_email);
                    $('#customer_phone').val(customer_phone);
                    $('#payment_status').val(payment_status);
                    $('#payment_method').append(payment_options);
                    $('#payment_method').val(payment_method);
                    $('#total_payment').val(total_payment);
                    $('#parent_id').val(eventId);
                    if (percentage_value != null) {
                        $('.percentage-field').removeClass('d-none');
                        $('.percentage_value').val(percentage_value);
                    }
                    var parts = date.split('-');
                    formattedDateStart = `${parts[1]}/${parts[2]}/${parts[0]}`;
                    var endDateParts = end_date.split('-');
                    formattedDateEnd = `${endDateParts[1]}/${endDateParts[2]}/${endDateParts[0]}`;
                    // Set the timepicker options and initialize it for the first input
                    // console.log(formattedDate,formattedDateEnd);
                    getPoolDetails(pool,formattedDateStart,formattedDateEnd);
                    $(".pickatime-formatTime-display").pickatime({
                        format: "H:i",
                        formatLabel: "<b>H</b>:i",
                        formatSubmit: "HH:i",
                        hiddenPrefix: "prefix__",
                        hiddenSuffix: "__suffix"
                    }).pickatime('picker').set('select', start_time);

                    // Set the timepicker options and initialize it for the second input
                    $(".pickatime-formatTime-display2").pickatime({
                        format: "H:i",
                        formatLabel: "<b>H</b>:i",
                        formatSubmit: "HH:i",
                        hiddenPrefix: "prefix__",
                        hiddenSuffix: "__suffix"
                    }).pickatime('picker').set('select', end_time);
                    myModal.show();
                }
            };

            /*=====================*/
            // Active Calender
            /*=====================*/
            function initializeCalendar() {
                var calendarOptions = {
                    selectable: true,
                    height: checkWidowWidth() ? 900 : 1052,
                    initialView: "timeGridDay",
                    // initialDate: `${newDate.getFullYear()}-${getDynamicMonth()}-07`,
                    headerToolbar: calendarHeaderToolbar,
                    // events: calendarEventsList,
                    events: function(info, successCallback, failureCallback) {
                        var start = info.start;
                        var end = info.end;
                        var pool_select = $('#pool_select_main option:selected').val();
                        var url = '{{ asset('') }}get-events';
                        $.ajax({
                            url: url,
                            type: 'GET',
                            data: {
                                pool_select: pool_select,
                                start: start.toISOString(),
                                end: end.toISOString()
                            },
                            success: function(response) {
                                console.log(response);
                                response.events.forEach(function(event) {
                                    var startDate = new Date(event.date_start +
                                        ' ' +
                                        event.start_time);
                                    var endDate = new Date(event.date_end + ' ' +
                                        event
                                        .end_time);
                                    event.start = startDate;
                                    event.end = endDate;
                                });
                                successCallback(response.events, );
                                createTitleFilter(response.events);
                            },
                            error: function(xhr, status, error) {
                                failureCallback(error);
                            }
                        });
                    },
                    select: calendarSelect,
                    unselect: function() {
                        console.log("unselected");
                    },
                    editable: true,
                    eventResizableFromStart: true,
                    eventResizable: true,
                    customButtons: {
                        ExportCsv: {
                            text: "Export Csv",
                            click: function() {
                                exportCalendarEventsToCsv(calendar);
                            },
                        },
                        AddEvent: {
                            text: "Add Event",
                            click: function() {
                                window.location = '{{ url('/Add-Event') }}';
                            },
                        },
                    },
                    eventClassNames: function({
                        event: calendarEvent
                    }) {
                        const getColorValue =
                            calendarsEvents[calendarEvent._def.extendedProps.calendar];
                        return [
                            "event-fc-color fc-bg-" + getColorValue,
                        ];
                    },

                    eventClick: calendarEventClick,
                    eventDrop: function(info) {
                        // Handle event drop
                        var event = info.event;

                        var getTime = function(date) {
                            var hours = date.getHours();
                            var minutes = date.getMinutes();
                            var seconds = date.getSeconds();

                            hours = (hours < 10 ? '0' : '') + hours;
                            minutes = (minutes < 10 ? '0' : '') + minutes;
                            seconds = (seconds < 10 ? '0' : '') + seconds;

                            return hours + ':' + minutes + ':' + seconds;
                        };
                        var newStart = getTime(event.start);
                        var newEnd = getTime(event.end);
                        var bokkingId = event.extendedProps.bookid;

                        console.log(bokkingId, newStart, newEnd);
                        $.ajax({
                            url: 'update-event-time',
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                eventId: bokkingId,
                                newStart: newStart,
                                newEnd: newEnd
                            },
                            success: function(response) {
                                if (response.success) {
                                    console.log('Event time updated successfully');
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Event time updated successfully',
                                        icon: 'success',
                                        customClass: {
                                            confirmButton: 'btn btn-primary'
                                        },
                                        buttonsStyling: false
                                    });
                                } else {
                                    console.error('Failed to update event time');
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Failed to update event time',
                                        icon: 'error',
                                        customClass: {
                                            confirmButton: 'btn btn-primary'
                                        },
                                        buttonsStyling: false
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Failed to update event time:', error);
                                event.setDates(info.oldStart, info
                                    .oldEnd);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Failed to update event time',
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false
                                });
                            }
                        });
                    },
                    eventTimeFormat: {
                        hour: 'numeric',
                        minute: '2-digit',
                        hour12: false
                    },
                    slotLabelFormat: {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    }
                }
                @if (isset($_GET['pool_select']))
                    calendarOptions.businessHours = [
                        @foreach ($startTimes as $day => $startTime)
                            {
                                daysOfWeek: [
                                    {{ strtolower(substr($day, 0, 3)) == 'thur' ? 4 : array_search($day, ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']) }}
                                ],
                                startTime: '{{ $startTime }}',
                                endTime: '{{ $endTimes[$day] }}'
                            },
                        @endforeach
                    ];
                @endif
                var calendar = new FullCalendar.Calendar(calendarEl, calendarOptions);
                calendar.render();
            }
            $('#pool_select').change(function() {
                initializeCalendar();
            });
            $('#pool_select').change();

            var titleFilterInitialized = false;

            function createTitleFilter(events) {
                if (!titleFilterInitialized) {
                    var uniqueTitles = [...new Set(events.map(event => event.title))];
                    var selectFilter = $(
                        '<select class="form-control" style="max-width:200px; margin-right: 10px;" id="title-filter"><option value="">All Titles</option><option value="Birthday">Birthday</option><option value="Private event">Private event</option><option value="Swimming Course">Swimming Course</option></select>'
                    );
                    selectFilter.on('change', function() {
                        var selectedTitle = $(this).val();
                        calendar.getEvents().forEach(function(event) {
                            if (selectedTitle === "" || event.title === selectedTitle) {
                                event.setProp('display', 'block');
                            } else {
                                event.setProp('display', 'background');
                            }
                        });
                    });
                    var thirdDiv = $('.fc-toolbar > div:nth-child(3)');
                    thirdDiv.addClass('d-flex').prepend(selectFilter);
                    titleFilterInitialized = true;
                }
            }

            function timeFormat(time24) {
                var timeSplit = time24.split(':');
                var hours = parseInt(timeSplit[0], 10);
                var minutes = timeSplit[1];

                var period = hours >= 12 ? 'PM' : 'AM';

                hours = hours % 12 || 12;

                minutes = minutes < 10 ? '0' + minutes : minutes;

                return hours + ':' + minutes + ' ' + period;
            }

            function dateFormat(date) {
                var Split = date.split('-');
                var year = Split[0];
                var month = Split[1];
                var day = Split[2];

                return day + '.' + month + '.' + year;
            }

            function exportCalendarEventsToCsv(calendar) {
                var events = calendar.getEvents();
                var csvContent = "data:text/csv;charset=utf-8,";
                csvContent +=
                    "Title,Customer Name,Customer Email,Customer Phone,Start Date,Start Time,End Date,End Time,Payment Status,Payment Method,Total Amount\n";
                events.forEach(function(event) {
                    var start = event.start ? event.start.toLocaleString() : "";
                    var end = event.end ? event.end.toLocaleString() : "";
                    var update_id = event.extendedProps.id,
                        date = dateFormat(event.extendedProps.date_start),
                        end_date = dateFormat(event.extendedProps.date_end),
                        start_time = event.extendedProps.start_time,
                        end_time = event.extendedProps.end_time,
                        customer_name = event.extendedProps.customer_name,
                        customer_email = event.extendedProps.customer_email,
                        customer_phone = event.extendedProps.customer_phone,
                        intervalDays = event.extendedProps.interval_Days,
                        intervalHours = event.extendedProps.interval_Hours,
                        intervalMinutes = event.extendedProps.interval_Minutes,
                        payment_status = event.extendedProps.payment_status,
                        payment_method = event.extendedProps.payment_method,
                        percentage_value = event.extendedProps.percentage_value,
                        total_payment = event.extendedProps.total_payment;
                    csvContent +=
                        `"${event.title}","${customer_name}","${customer_email}","${customer_phone}","${date}","${start_time}","${end_date}","${end_time}","${payment_status}","${payment_method}","${total_payment}"\n`;
                });
                var encodedUri = encodeURI(csvContent);
                var link = document.createElement("a");
                link.setAttribute("href", encodedUri);
                link.setAttribute("download", "calendar_events.csv");
                document.body.appendChild(link);
                link.click();
            }

            /*=====================*/
            // Update Calender Event
            /*=====================*/
            // getModalUpdateBtnEl.addEventListener("click", function() {
            //     var getPublicID = this.dataset.fcEventPublicId;
            //     var getTitleUpdatedValue = getModalTitleEl.value;
            //     var getEvent = calendar.getEventById(getPublicID);
            //     var getModalUpdatedCheckedRadioBtnEl = document.querySelector(
            //         'input[name="event_level"]:checked'
            //     );

            //     var getModalUpdatedCheckedRadioBtnValue =
            //         getModalUpdatedCheckedRadioBtnEl !== null ?
            //         getModalUpdatedCheckedRadioBtnEl.value :
            //         "";

            //     getEvent.setProp("title", getTitleUpdatedValue);
            //     getEvent.setExtendedProp("calendar", getModalUpdatedCheckedRadioBtnValue);
            //     myModal.hide();
            // });
            /*=====================*/
            // Add Calender Event
            /*=====================*/
            getModalAddBtnEl.addEventListener("click", function() {
                var getModalCheckedRadioBtnEl = document.querySelector(
                    'input[name="event_level"]:checked'
                );

                var getTitleValue = getModalTitleEl.value;
                var setModalStartDateValue = getModalStartDateEl.value;
                var setModalEndDateValue = getModalEndDateEl.value;
                var getModalCheckedRadioBtnValue =
                    getModalCheckedRadioBtnEl !== null ? getModalCheckedRadioBtnEl.value : "";

                calendar.addEvent({
                    id: 12,
                    title: getTitleValue,
                    start: setModalStartDateValue,
                    end: setModalEndDateValue,
                    allDay: true,
                    extendedProps: {
                        calendar: getModalCheckedRadioBtnValue
                    },
                });
                myModal.hide();
            });
            /*=====================*/
            // Calendar Init
            /*=====================*/

            var myModal = new bootstrap.Modal(document.getElementById("eventModal"));
            var modalToggle = document.querySelector(".fc-addEventButton-button ");

            document
                .getElementById("eventModal")
                .addEventListener("hidden.bs.modal", function(event) {
                    var eventId = info.event.id;
                    document.getElementById("event-form").action = 'Event-update/' + eventId;
                    getModalTitleEl.value = "";
                    getModalStartDateEl.value = "";
                    getModalEndDateEl.value = "";
                    var getModalIfCheckedRadioBtnEl = document.querySelector(
                        'input[name="event_level"]:checked'
                    );
                    if (getModalIfCheckedRadioBtnEl !== null) {
                        getModalIfCheckedRadioBtnEl.checked = false;
                    }
                });
        });

        $(document).on('change', '#end_date_time', function() {
            var start_date_time = $('#start_date_time').val();
            var parent_id = $('#parent_id').val();
            var end_date_time = $('#end_date_time').val();
            var [start_date, start_time] = start_date_time.split("T");
            var [end_date, end_time] = end_date_time.split("T");
            var url = "{{ asset('') }}check-availablity";
            if (start_date_time) {
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
                            $('#start_date_time').removeClass('is-invalid');
                            $('#end_date_time').removeClass('is-invalid');

                        } else {
                            // Time slot is not available
                            console.log('Time slot is not available');
                            $('#start_date_time').addClass('is-invalid');
                            $('#end_date_time').addClass('is-invalid').after(
                                '<span class="invalid-feedback" role="alert"><strong>Time slot not available.</strong></span>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(error);
                    }
                });

            }
        })
        $(document).on('change', '.event-type', function() {
            var event_type = $('.event-type option:selected').val();
            if (event_type == "Swimming Course") {
                $('.percentage-field').removeClass('d-none');
            } else {
                $('.percentage-field').addClass('d-none');
            }
        })
        function getPoolDetails(poolID,start_date,end_date){
            console.log(start_date,end_date);
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
                            // $(".datepicker-autoclose").datepicker('destroy');
                            $(".datepicker-autoclose").datepicker({
                                autoclose: true,
                                todayHighlight: true,
                                startDate: new Date(),
                                daysOfWeekDisabled: response.disabledDays
                            }).datepicker('setDate', start_date);
                            // $(".datepicker-autoclose2").datepicker('destroy');
                            $(".datepicker-autoclose2").datepicker({
                                autoclose: true,
                                todayHighlight: true,
                                startDate: new Date(),
                                daysOfWeekDisabled: response.disabledDays
                            }).datepicker('setDate', end_date);
                        } else {
                            console.log('Error:', response.message);
                        }
                    }
                });
            }
        }
        $('#pool_select').change(function() {
            var poolID = $("#pool_select option:selected").val();
            getPoolDetails(poolID,formattedDateStart,formattedDateEnd);
        });
    </script>
@endsection
