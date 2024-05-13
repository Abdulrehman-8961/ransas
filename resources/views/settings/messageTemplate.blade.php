@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">תבנית הודעה</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted text-decoration-none"
                                        href="{{ url('/Home') }}">
                                        דשבורד </a></li>
                                <li class="breadcrumb-item" aria-current="page">תבנית הודעה</li>
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
                @if (isset($_GET['temp']))
                    @php
                        $pool_option = DB::table('pool')->where('is_deleted', 0)->get();
                    @endphp
                    <form id="search-form" action="{{ url()->current() }}" method="get">
                        <input type="hidden" name="temp" value="{{ @$_GET['temp'] }}">
                        <div class="row mb-3">
                            <div class="col-md-4 col-12">
                                <label for="">בריכות</label>
                                <select class="form-control" name="pool_id" id="pool_id"
                                    onchange="document.getElementById('search-form').submit();">
                                    @foreach ($pool_option as $row)
                                        <option value="{{ $row->id }}"
                                            {{ @$_GET['pool_id'] == $row->id ? 'selected' : '' }}>
                                            {{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                @endif
                <form action="{{ url('/Template/Save') }}"
                    method="post">
                    @csrf
                    <input type="hidden" name="template_id" value="{{ @$_GET['temp'] }}">
                    <input type="hidden" name="pool_id" value="{{ @$_GET['pool_id'] }}">
                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <label for="name" class="form-label">נושא</label>
                            <input type="text" class="form-control" value="{{ @$template->subject }}" name="name"
                                id="name" required>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label for="status" class="form-label">סטטוס</label>
                            <select class="form-control" name="status" id="status">
                                <option value="Send" {{ @$template->status == 'Send' ? 'selected' : '' }}>לשלוח
                                </option>
                                <option value="Stop" {{ @$template->status == 'Stop' ? 'selected' : '' }}>לא לשלוח
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">
                            Content
                            <ul class="text-danger mb-0 fs-2 ps-1">
                                <li>שם הבריכה: {pool_name}</li>
                                <li>סוג הזמנה: {booking_type}</li>
                                <li>שם לקוח: {customer_name}</li>
                                <li>תאריך הזמנה: {date}</li>
                                <li>זמן הזמנה: {time}</li>
                                <li>אמצעי תשלום: {payment_method}</li>
                                <li>סטטוס תשלום: {payment_status}</li>
                                <li>סכום כולל : {total_amount}</li>
                            </ul>
                        </label>
                        <textarea rows="6" class="form-control" name="content" id="content" rows="3" required>{!! @$template->content !!}</textarea>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mt-2">שמור שינויים</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection

@section('javascript')
    <script>
        @if (!isset($_GET['pool_id']))
            document.getElementById('search-form').submit();
        @endif
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
