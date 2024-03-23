@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Message Template</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted text-decoration-none"
                                        href="{{ url('/Users') }}">
                                        Users</a></li>
                                <li class="breadcrumb-item" aria-current="page">Message Template</li>
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
        <div class="card w-100 position-relative overflow-hidden">
            <div class="card-body">
                <form action="{{ url('/Message-Template/Save') }}" method="post">
                    @csrf
                    <input type="hidden" name="template_id" value="{{ @$_GET['temp'] }}">
                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <label for="name" class="form-label">Subject</label>
                            <input type="text" class="form-control" value="{{ @$template->subject }}" name="name" id="name">
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="Send" {{ @$template->status == "Send" ? "selected" : "" }}>Send</option>
                                <option value="Stop" {{ @$template->status == "Stop" ? "selected" : "" }}>Stop</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">
                            Content
                            <ul class="text-danger mb-0 fs-2 ps-1">
                                <li>Booking Type : {booking_type}</li>
                                <li>Customer Name : {customer_name}</li>
                                <li>Booking Date : {date}</li>
                                <li>Booking Time : {time}</li>
                                <li>Payment Method : {payment_method}</li>
                                <li>Payment Status : {payment_status}</li>
                                <li>Total Amount : {total_amount}</li>
                            </ul>
                        </label>
                        <textarea rows="6" class="form-control" name="content" id="content" rows="3">{!! @$template->content !!}</textarea>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
                    </div>
                </form>
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
