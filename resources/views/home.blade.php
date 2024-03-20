@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <!--  Owl carousel -->
        <div class="owl-carousel  counter-carousel owl-theme">
            <div class="item">
                <div class="card border-0 zoom-in bg-light-primary shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('public') }}/dist/images/svgs/icon-user-male.svg" width="50" height="50"
                                class="mb-3" alt="" />
                            <p class="fw-semibold fs-3 text-primary mb-1"> סך ההכנסות (החודש) </p>
                            <h5 class="fw-semibold text-primary mb-0">₪9600</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 zoom-in bg-light-warning shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('public') }}/dist/images/svgs/icon-briefcase.svg" width="50"
                                height="50" class="mb-3" alt="" />
                            <p class="fw-semibold fs-3 text-warning mb-1">ימי הולדת</p>
                            <h5 class="fw-semibold text-warning mb-0">300</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 zoom-in bg-light-info shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('public') }}/dist/images/svgs/icon-mailbox.svg" width="50" height="50"
                                class="mb-3" alt="" />
                            <p class="fw-semibold fs-3 text-info mb-1">קורסי שחייה</p>
                            <h5 class="fw-semibold text-info mb-0">356</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 zoom-in bg-light-danger shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('public') }}/dist/images/svgs/icon-favorites.svg" width="50"
                                height="50" class="mb-3" alt="" />
                            <p class="fw-semibold fs-3 text-danger mb-1">שעות שחייה זמינות</p>
                            <h5 class="fw-semibold text-danger mb-0">696</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 zoom-in bg-light-success shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('public') }}/dist/images/svgs/icon-speech-bubble.svg" width="50"
                                height="50" class="mb-3" alt="" />
                            <p class="fw-semibold fs-3 text-success mb-1">שעות שחייה תפוסות</p>
                            <h5 class="fw-semibold text-success mb-0">96</h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>
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

        <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-center modal-c ontent modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel">
                            View Event Details
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="">
                                    <table class="table">
                                        <tr>
                                            <th>Type</th>
                                            <td class="booking_type">Birthday</td>
                                        </tr>
                                        <tr>
                                            <th>Date</th>
                                            <td class="booking_date">12.03.24</td>
                                        </tr>
                                        <tr>
                                            <th>Time</th>
                                            <td class="time_duration">1 hour</td>
                                        </tr>
                                        <tr>
                                            <th>Client Name</th>
                                            <td class="name">Huzaifa Ahmed</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td class="email">s@gmail.com</td>
                                        </tr>
                                        <tr>
                                            <th>Total Payment</th>
                                            <td class="total">1000</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Type</th>
                                            <td class="payment_type">1000</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Status</th>
                                            <td><span class="status">Not Paid</span> <a class="ms-3 btn-pay"
                                                    href="javascript:;">Click To
                                                    Pay</a>
                                            </td>
                                        </tr>

                                    </table>

                                </div>
                            </div>




                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-success  d-none btn-update-event" data-fc-event-public-id="">
                            Update changes
                        </button>
                        <button type="button" class="btn btn-primary d-none btn-add-event">
                            Add Event
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL -->
    </div>
    </div>
    </div>
    </div>
    <form action="{{ url('/payment') }}" id="payment-form" method="POST">
        @csrf
        <input type="hidden" name="amount" id="transaction_amount">
        <input type="hidden" name="customer_name" id="customer_name">
        <input type="hidden" name="customer_email" id="customer_email">
        <input type="hidden" name="customer_phone" id="customer_phone">
        <input type="hidden" name="book_type" id="book_type">
        <input type="hidden" name="book_id" id="book_id">

    </form>
@endsection

@section('javascript')
    <script src="{{ asset('public') }}/dist/libs/fullcalendar/index.global.min.js"></script>
    <script type="text/javascript">
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
                left: "prev next ExportCsv",
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

            };
            /*=====================*/
            // Calendar AddEvent fn.
            /*=====================*/


            /*=====================*/
            // Calender Event Function
            /*=====================*/
            var calendarEventClick = function(info) {
                var eventObj = info.event;
                var bookid = eventObj.extendedProps.bookid,
                    book_type = eventObj.extendedProps.book_type,
                    date = eventObj.extendedProps.date_start,
                    customer_name = eventObj.extendedProps.customer_name,
                    customer_email = eventObj.extendedProps.customer_email,
                    customer_phone = eventObj.extendedProps.customer_phone,
                    intervalDays = eventObj.extendedProps.interval_Days,
                    intervalHours = eventObj.extendedProps.interval_Hours,
                    intervalMinutes = eventObj.extendedProps.interval_Minutes,
                    payment_status = eventObj.extendedProps.payment_status,
                    payment_method = eventObj.extendedProps.payment_method,
                    total_payment = eventObj.extendedProps.total_payment;

                if (eventObj.url) {
                    window.open(eventObj.url);

                    info.jsEvent.preventDefault();
                } else {
                    // console.log(intervalDays, intervalHours, intervalMinutes, date);
                    var getModalEventId = eventObj._def.publicId;
                    var getModalEventLevel = eventObj._def.extendedProps["calendar"];
                    var getModalCheckedRadioBtnEl = document.querySelector(
                        `input[value="${getModalEventLevel}"]`
                    );
                    $('.booking_type').text(eventObj.title);
                    $('.booking_date').text(date);
                    $('.name').text(customer_name);
                    $('.email').text(customer_email);
                    $('.total').text(total_payment);
                    $('.payment_type').text(payment_method);
                    $('.status').text(payment_status);
                    console.log(payment_status, payment_method)
                    if (payment_method == "Card" && (payment_status == "Not Paid" || payment_status ==
                            "On Hold")) {
                        $('.btn-pay').removeClass('d-none');
                        $('.btn-pay').attr({
                            'data-amount': total_payment,
                            'data-customer': customer_name,
                            'data-customer_email': customer_email,
                            'data-book_type': book_type,
                            'data-book_id': bookid,
                            'data-customer_phone': customer_phone
                        });
                    } else {
                        $('.btn-pay').addClass('d-none');

                    }
                    $('.time_duration').text(
                        (intervalDays != "0" ? intervalDays + ' Days ' : '') +
                        (intervalHours != "0" ? intervalHours + ' Hour ' : '') +
                        (intervalMinutes != "0" ? intervalMinutes + ' Minutes' : '')
                    );

                    myModal.show();
                }
            };

            function exportCalendarEventsToCsv(calendar) {
                var events = calendar.getEvents();
                var csvContent = "data:text/csv;charset=utf-8,";
                csvContent +=
                    "Title,Customer Name,Customer Email,Customer Phone,Start Date,Start Time,End Date,End Time,Payment Status,Payment Method,Total Amount\n";
                events.forEach(function(event) {
                    var start = event.start ? event.start.toLocaleString() : "";
                    var end = event.end ? event.end.toLocaleString() : "";
                    var update_id = event.extendedProps.id,
                        date = event.extendedProps.date_start,
                        end_date = event.extendedProps.date_end,
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
            // Active Calender
            /*=====================*/
            var calendar = new FullCalendar.Calendar(calendarEl, {
                selectable: true,
                height: checkWidowWidth() ? 900 : 1052,
                initialView: "timeGridDay",
                // initialDate: `${newDate.getFullYear()}-${getDynamicMonth()}`,
                headerToolbar: calendarHeaderToolbar,
                // events: calendarEventsList,
                events: function(info, successCallback, failureCallback) {
                    var start = info.start;
                    var end = info.end;
                    var url = '{{ asset('') }}get-events';
                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: {
                            start: start.toISOString(),
                            end: end.toISOString()
                        },
                        success: function(response) {
                            // console.log(response);
                            response.events.forEach(function(event) {
                                var startDate = new Date(event.date_start + ' ' +
                                    event.start_time);
                                var endDate = new Date(event.date_end + ' ' + event
                                    .end_time);
                                event.start = startDate;
                                event.end = endDate;
                            });
                            successCallback(response.events);
                            createTitleFilter(response.events);
                        },
                        error: function(xhr, status, error) {
                            failureCallback(error);
                        }
                    });
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
                },
                select: calendarSelect,
                unselect: function() {
                    console.log("unselected");
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

                    console.log(bokkingId,newStart,newEnd);
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
                        }
                    });
                },
                // windowResize: function(arg) {
                //     if (checkWidowWidth()) {
                //         calendar.changeView("listWeek");
                //         calendar.setOption("height", 900);
                //     } else {
                //         calendar.changeView("dayGridMonth");
                //         calendar.setOption("height", 1052);
                //     }
                // },
            });

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
                                event.setProp('display', 'none');
                            }
                        });
                    });
                    var thirdDiv = $('.fc-toolbar > div:nth-child(3)');
                    thirdDiv.addClass('d-flex').prepend(selectFilter);
                    titleFilterInitialized = true;
                }
            }

            /*=====================*/
            // Update Calender Event
            /*=====================*/
            getModalUpdateBtnEl.addEventListener("click", function() {
                var getPublicID = this.dataset.fcEventPublicId;
                var getTitleUpdatedValue = getModalTitleEl.value;
                var getEvent = calendar.getEventById(getPublicID);
                var getModalUpdatedCheckedRadioBtnEl = document.querySelector(
                    'input[name="event-level"]:checked'
                );

                var getModalUpdatedCheckedRadioBtnValue =
                    getModalUpdatedCheckedRadioBtnEl !== null ?
                    getModalUpdatedCheckedRadioBtnEl.value :
                    "";

                getEvent.setProp("title", getTitleUpdatedValue);
                getEvent.setExtendedProp("calendar", getModalUpdatedCheckedRadioBtnValue);
                myModal.hide();
            });
            /*=====================*/
            // Add Calender Event
            /*=====================*/
            getModalAddBtnEl.addEventListener("click", function() {
                var getModalCheckedRadioBtnEl = document.querySelector(
                    'input[name="event-level"]:checked'
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
            calendar.render();
            var myModal = new bootstrap.Modal(document.getElementById("eventModal"));
            var modalToggle = document.querySelector(".fc-addEventButton-button ");
            document
                .getElementById("eventModal")
                .addEventListener("hidden.bs.modal", function(event) {

                });
        });
        $(document).on('click', '.btn-pay', function() {
            var total_payment = $(this).data('amount');
            var customer_name = $(this).data('customer');
            var customer_email = $(this).data('customer_email');
            var customer_phone = $(this).data('customer_phone');
            var book_type = $(this).data('book_type');
            var book_id = $(this).data('book_id');
            if (total_payment) {
                $('#transaction_amount').val(total_payment);
                $('#customer_name').val(customer_name);
                $('#customer_email').val(customer_email);
                $('#customer_phone').val(customer_phone);
                $('#book_type').val(book_type);
                $('#book_id').val(book_id);
                $('#payment-form').submit();
            }
        });
    </script>
@endsection
